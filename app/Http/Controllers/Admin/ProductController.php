<?php
// app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'primaryImage'])
                          ->latest()
                          ->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'brand' => 'nullable|string|max:255',
            'gender' => 'required|in:pria,wanita,anak,unisex',
            'color' => 'nullable|string|max:255',
            'shape' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');

        $product = Product::create($validated);

        // untuk menghandle upload image lebih dari satu
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $product->load('images');
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'brand' => 'nullable|string|max:255',
            'gender' => 'required|in:pria,wanita,anak,unisex',
            'color' => 'nullable|string|max:255',
            'shape' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5048',
            'delete_images' => 'array',
            'delete_images.*' => 'exists:product_images,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_new'] = $request->has('is_new');
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        
        if ($request->has('delete_images')) {
            ProductImage::whereIn('id', $request->delete_images)->delete();
        }

        
        if ($request->hasFile('images')) {
            $existingCount = $product->images()->count();
            
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $existingCount === 0 && $index === 0,
                    'sort_order' => $existingCount + $index
                ]);
            }
        }

        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('admin.products.index')
                        ->with('success', 'Produk berhasil dihapus!');
    }

    public function setPrimaryImage(Request $request, Product $product)
    {
        $imageId = $request->image_id;
        
        
        $product->images()->update(['is_primary' => false]);
        
        
        ProductImage::where('id', $imageId)->update(['is_primary' => true]);
        
        return response()->json(['success' => true]);
    }
}