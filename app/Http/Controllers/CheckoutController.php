<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    // Hiển thị form thanh toán
    public function showCheckoutForm()
    {
        $cartItems = Cart::getContent();
        return view('checkout.form', compact('cartItems'));
    }

    // Xử lý thanh toán và lưu đơn hàng
    public function processCheckout(Request $request)
    {
        // Validate thông tin khách hàng
        $request->validate([
            'ten_khach_hang' => 'required|string|max:100',
            'email' => 'required|email',
            'so_dien_thoai' => 'required|string|max:15',
            'dia_chi' => 'required|string|max:255'
        ]);

        // Tạo đơn hàng mới
        $donHang = DonHang::create([
            'ten_khach_hang' => $request->ten_khach_hang,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'tong_tien' => Cart::getTotal()
        ]);

        // Lưu chi tiết đơn hàng
        foreach (Cart::getContent() as $item) {
            ChiTietDonHang::create([
                'id_dh' => $donHang->id_dh,
                'id_sp' => $item->id,
                'so_luong' => $item->quantity,
                'gia_ban' => $item->price,
                'tong_tien_sp' => $item->quantity * $item->price
            ]);

            // Giảm số lượng tồn kho sản phẩm
            $sanPham = SanPham::find($item->id);
            $sanPham->so_luong_ton_sp -= $item->quantity;
            $sanPham->save();
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        Cart::clear();

        return redirect('/')->with('success', 'Thanh toán thành công! Đơn hàng đã được ghi nhận.');
    }
}
