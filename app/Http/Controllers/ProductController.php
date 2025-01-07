<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $sanPhams = SanPham::all();
        return view('pages.products', compact('sanPhams'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        return view('pages.add_product');
    }

    // Xử lý lưu sản phẩm vào CSDL
    public function store(Request $request)
    {
        $request->validate([
            'ten_sp' => 'required|max:150',
            'mo_ta_sp' => 'nullable',
            'gia_sp' => 'required|numeric|min:0',
            'so_luong_ton_sp' => 'required|integer|min:0',
            'hinh_anh_sp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $hinhAnh = null;
        if ($request->hasFile('hinh_anh_sp')) {
            $hinhAnh = $request->file('hinh_anh_sp')->store('images', 'public');
        }

        SanPham::create([
            'ten_sp' => $request->ten_sp,
            'mo_ta_sp' => $request->mo_ta_sp,
            'gia_sp' => $request->gia_sp,
            'so_luong_ton_sp' => $request->so_luong_ton_sp,
            'hinh_anh_sp' => $hinhAnh,
            'ngay_tao_sp' => now(),
            'ngay_cap_nhat_sp' => now()
        ]);

        return redirect('/san-pham')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    // ✅ Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $sanPham = SanPham::findOrFail($id);
        return view('pages.edit_product', compact('sanPham'));
    }

    // ✅ Xử lý cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_sp' => 'required|max:150',
            'mo_ta_sp' => 'nullable',
            'gia_sp' => 'required|numeric|min:0',
            'so_luong_ton_sp' => 'required|integer|min:0',
            'hinh_anh_sp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sanPham = SanPham::findOrFail($id);

        // Nếu có ảnh mới, xóa ảnh cũ và lưu ảnh mới
        if ($request->hasFile('hinh_anh_sp')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($sanPham->hinh_anh_sp && file_exists(storage_path('app/public/' . $sanPham->hinh_anh_sp))) {
                unlink(storage_path('app/public/' . $sanPham->hinh_anh_sp));
            }

            // Lưu ảnh mới
            $hinhAnh = $request->file('hinh_anh_sp')->store('images', 'public');
            $sanPham->hinh_anh_sp = $hinhAnh;
        }

        // Cập nhật thông tin sản phẩm
        $sanPham->update([
            'ten_sp' => $request->ten_sp,
            'mo_ta_sp' => $request->mo_ta_sp,
            'gia_sp' => $request->gia_sp,
            'so_luong_ton_sp' => $request->so_luong_ton_sp,
            'ngay_cap_nhat_sp' => now()
        ]);

        return redirect('/san-pham')->with('success', 'Cập nhật sản phẩm thành công!');
    }


    // ✅ Xóa sản phẩm
    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $sanPham->delete();
        return redirect('/san-pham')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
