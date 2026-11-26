<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Display the public homepage.
     */
    public function home(): View
    {
        $featuredProducts = Product::query()
            ->with('category')
            ->orderByRaw("CASE WHEN stock_status = 'available' THEN 0 ELSE 1 END")
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $totalProducts = Product::query()->count();
        $totalCategories = Category::query()->count();

        return view('public.home', compact(
            'featuredProducts',
            'categories',
            'totalProducts',
            'totalCategories'
        ));
    }

    /**
     * Display the public product catalog with search, category filter, and pagination.
     */
    public function products(Request $request): View
    {
        $search = trim((string) $request->query('cari', ''));
        $selectedCategorySlug = trim((string) $request->query('kategori', ''));

        $categories = Category::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $activeCategory = $selectedCategorySlug !== ''
            ? $categories->firstWhere('slug', $selectedCategorySlug)
            : null;

        $productsQuery = Product::query()->with('category');

        if ($activeCategory) {
            $productsQuery->where('category_id', $activeCategory->id);
        } elseif ($selectedCategorySlug !== '') {
            $productsQuery->whereRaw('1 = 0');
        }

        if ($search !== '') {
            $productsQuery->where('name', 'like', '%'.$search.'%');
        }

        $products = $productsQuery
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.products', compact(
            'products',
            'categories',
            'activeCategory',
            'selectedCategorySlug',
            'search'
        ));
    }

    /**
     * Display a single product detail page by slug or ID.
     */
    public function productDetail(string $slug): View
    {
        $product = Product::query()
            ->with('category')
            ->where('slug', $slug)
            ->when(ctype_digit($slug), fn ($query) => $query->orWhere('id', (int) $slug))
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('public.product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        $totalProducts = Product::query()->count();
        $totalCategories = Category::query()->count();

        return view('public.about', compact('totalProducts', 'totalCategories'));
    }
}
