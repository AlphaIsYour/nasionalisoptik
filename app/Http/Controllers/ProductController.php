<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->get();
        $services = Service::active()->ordered()->get();
        
        $query = Product::with(['category', 'primaryImage'])
                       ->active();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->whereIn('gender', $request->gender);
        }

        // Filter by color
        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        // Filter by shape
        if ($request->filled('shape')) {
            $query->whereIn('shape', $request->shape);
        }

        // Filter by material
        if ($request->filled('material')) {
            $query->whereIn('material', $request->material);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->whereIn('brand', $request->brand);
        }

        // Sorting
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(discount_price, price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(discount_price, price) DESC');
                break;
            case 'newest':
                $query->latest();
                break;
            default: // popular
                $query->orderBy('rating', 'desc')->orderBy('review_count', 'desc');
        }

        // AJAX request for filtering
        if ($request->ajax()) {
            $products = $query->paginate(12);
            
            // Transform products for JSON response
            $transformedProducts = $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'discount_percentage' => $product->discount_percentage,
                    'rating' => $product->rating,
                    'is_new' => $product->is_new,
                    'primary_image' => $product->primaryImage ? [
                        'image_path' => $product->primaryImage->image_path
                    ] : null
                ];
            });
            
            return response()->json([
                'products' => $transformedProducts,
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ]
            ]);
        }

        $products = $query->paginate(12);
        
        return view('pages.products', compact('products', 'categories', 'services'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'images'])
                         ->where('slug', $slug)
                         ->active()
                         ->firstOrFail();
        
        // Related products
        $relatedProducts = Product::with('primaryImage')
                                 ->where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->active()
                                 ->take(4)
                                 ->get();
        
        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }
}