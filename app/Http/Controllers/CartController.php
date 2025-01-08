<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use Darryldecode\Cart\Facades\CartFacade as Cart; // Sửa lỗi import Cart

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = Cart::getContent();
        return view('cart.index', compact('cartItems'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id)
    {
        $product = SanPham::findOrFail($id);

        Cart::add([
            'id' => $product->id_sp,
            'name' => $product->ten_sp,
            'price' => $product->gia_sp,
            'quantity' => $request->quantity ?? 1,
            'attributes' => [
                'hinh_anh_sp' => $product->hinh_anh_sp
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật!');
    }

    // Xóa một sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        Cart::clear();
        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được làm trống!');
    }
}
