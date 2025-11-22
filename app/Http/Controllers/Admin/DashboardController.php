<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_payments' => Order::where('payment_status', 'pending')->where('payment_proof', '!=', null)->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'total_products' => Product::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_categories' => Category::active()->count(),
            'total_services' => Service::active()->count(),
            'active_products' => Product::active()->count(),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $recent_products = Product::with('category', 'primaryImage')
                                   ->latest()
                                   ->take(5)
                                   ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recent_orders' => $recent_orders,
            'recent_products' => $recent_products,
            'totalOrders' => $stats['total_orders'],
            'pendingOrders' => $stats['pending_orders'],
            'pendingPayments' => $stats['pending_payments'],
            'totalRevenue' => $stats['total_revenue'],
            'totalProducts' => $stats['total_products'],
            'activeProducts' => $stats['active_products'],
            'totalCategories' => $stats['total_categories'],
            'totalServices' => $stats['total_services'],
        ]);
    }
}