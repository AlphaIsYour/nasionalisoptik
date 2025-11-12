<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::active()->count(),
            'totalCategories' => Category::active()->count(),
            'totalServices' => Service::active()->count(),
            'recentProducts' => Product::with('category', 'primaryImage')
                                      ->latest()
                                      ->take(5)
                                      ->get(),
        ];
        
        return view('admin.dashboard', $data);
    }
}