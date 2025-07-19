<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Halaman utama (katalog produk)
Route::get('/', [ProductController::class, 'index'])->name('home');

// Auth routes (login, register, logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Produk: urutan penting!
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Form tambah produk
Route::post('/products', [ProductController::class, 'store'])->name('products.store');         // Simpan produk
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Edit produk
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');  // Update
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Hapus
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); // Detail produk


Route::middleware(['auth'])->group(function () {
    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Review produk
    Route::post('/products/{productId}/review', [ProductReviewController::class, 'store'])->name('products.review.store');
});


//admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
;

// Route pemesanan (order)

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
; 





// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'environment' => app()->environment()
    ]);
});

// Fallback route for SPA (if needed)
Route::fallback(function () {
    return response()->json([
        'message' => 'Route not found'
    ], 404);
});
