<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có trong giỏ hàng thì tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['so_luong']++;
        } else {
            // Nếu chưa có, thêm sản phẩm mới
            $cart[$id] = [
                'ten_sp' => $sanPham->ten_sp,
                'gia_sp' => $sanPham->gia_sp,
                'so_luong' => 1,
                'hinh_anh_sp' => $sanPham->hinh_anh_sp
            ];
        }

        session()->put('cart', $cart);
        return redirect('/gio-hang')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect('/gio-hang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

    // Thanh toán đơn giản (xóa giỏ hàng)
    public function checkout()
    {
        session()->forget('cart');
        return redirect('/san-pham')->with('success', 'Thanh toán thành công!');
    }
}
