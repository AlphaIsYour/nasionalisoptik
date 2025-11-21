<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\User\AuthController as UserAuthController; // ← Tambah ini

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// User Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
});

Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth')->name('logout');

// User Profile & Cart Routes (Protected)
// User Profile, Cart & Orders Routes (Protected)
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Cart
    Route::get('/cart', [\App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [\App\Http\Controllers\User\CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartItem}', [\App\Http\Controllers\User\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [\App\Http\Controllers\User\CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [\App\Http\Controllers\User\CartController::class, 'clear'])->name('cart.clear');
    
    // Checkout
    Route::get('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [\App\Http\Controllers\User\CheckoutController::class, 'success'])->name('checkout.success');
    
    // Orders
    Route::get('/orders', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/upload-proof', [\App\Http\Controllers\User\OrderController::class, 'uploadProof'])->name('orders.upload-proof');
    Route::post('/orders/{order}/cancel', [\App\Http\Controllers\User\OrderController::class, 'cancel'])->name('orders.cancel');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Products Management
        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/set-primary-image', [AdminProductController::class, 'setPrimaryImage'])->name('products.set-primary');
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    });
});

