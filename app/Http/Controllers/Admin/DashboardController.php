<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the administrator dashboard overview.
     */
    public function index(): View
    {
        $totalProducts = Product::query()->count();
        $availableProducts = Product::query()
            ->where('stock_status', Product::STATUS_AVAILABLE)
            ->count();
        $totalCategories = Category::query()->count();

        $latestProduct = Product::query()
            ->with('category')
            ->latest()
            ->first();

        $recentProducts = Product::query()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $categoriesSummary = Category::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'availableProducts',
            'totalCategories',
            'latestProduct',
            'recentProducts',
            'categoriesSummary'
        ));
    }
}
