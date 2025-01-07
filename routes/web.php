<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; // ✅ THÊM DÒNG NÀY ĐỂ IMPORT CONTROLLER

// Trang chủ
Route::get('/', function () {
    return view('pages.home');
});

// Quản lý sản phẩm
Route::get('/san-pham', [ProductController::class, 'index']);
Route::get('/san-pham/them', [ProductController::class, 'create']);
Route::post('/san-pham/them', [ProductController::class, 'store']);
Route::get('/san-pham/sua/{id}', [ProductController::class, 'edit']);
Route::post('/san-pham/sua/{id}', [ProductController::class, 'update']);
Route::delete('/san-pham/xoa/{id}', [ProductController::class, 'destroy']);

// ✅ Giỏ hàng (Cart)
Route::get('/gio-hang', [CartController::class, 'index']);
Route::post('/gio-hang/them/{id}', [CartController::class, 'add']);
Route::delete('/gio-hang/xoa/{id}', [CartController::class, 'remove']);
Route::post('/gio-hang/thanh-toan', [CartController::class, 'checkout']);

// Trang liên hệ
Route::get('/lien-he', function () {
    return view('pages.contact');
});
