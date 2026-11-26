<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products in the admin dashboard.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('cari', ''));
        $categoryId = $request->query('category_id');

        $products = Product::query()
            ->with('category')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', '%'.$search.'%'))
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $request->hasFile('image')
            ? $this->storeProductImage($request->file('image'))
            : null;

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Product::generateUniqueSlug($validated['name']),
            'price' => (int) round((float) $validated['price']),
            'description' => $validated['description'],
            'image' => $imagePath,
            'stock_status' => $validated['stock_status'],
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $this->deleteProductImage($product->image);
            $imagePath = $this->storeProductImage($request->file('image'));
        }

        $slug = $product->name !== $validated['name']
            ? Product::generateUniqueSlug($validated['name'], $product->id)
            : $product->slug;

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'price' => (int) round((float) $validated['price']),
            'description' => $validated['description'],
            'image' => $imagePath,
            'stock_status' => $validated['stock_status'],
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product and its image from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteProductImage($product->image);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Store a product image in the public disk with a unique filename.
     */
    private function storeProductImage(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $filename = (string) Str::uuid().'.'.$extension;

        return $file->storeAs('products', $filename, 'public');
    }

    /**
     * Delete a product image from the public disk if it exists.
     */
    private function deleteProductImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
