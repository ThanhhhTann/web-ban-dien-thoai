<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
// Trang chủ
Route::get('/', [HomeController::class, 'index']);

// Quản lý sản phẩm
Route::get('/san-pham', [ProductController::class, 'index']); // Hiển thị danh sách sản phẩm + tìm kiếm + phân trang
Route::get('/san-pham/create', [ProductController::class, 'create']); // Form thêm sản phẩm
Route::post('/san-pham', [ProductController::class, 'store']); // Xử lý lưu sản phẩm
Route::get('/san-pham/{id}/edit', [ProductController::class, 'edit']); // Form chỉnh sửa sản phẩm
Route::put('/san-pham/{id}', [ProductController::class, 'update']); // Xử lý cập nhật sản phẩm
Route::delete('/san-pham/{id}', [ProductController::class, 'destroy']); // Xóa sản phẩm


// Giỏ hàng
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/gio-hang/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/gio-hang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/gio-hang/clear', [CartController::class, 'clear'])->name('cart.clear');


Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
