<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm có phân trang và tìm kiếm
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ form
        $search = $request->input('search');

        // Nếu có từ khóa, thực hiện tìm kiếm, nếu không, hiển thị tất cả sản phẩm
        $products = SanPham::when($search, function ($query, $search) {
            return $query->where('ten_sp', 'like', "%{$search}%");
        })
            ->paginate(5); // Phân trang 5 sản phẩm mỗi trang

        return view('sanpham.index', compact('products', 'search'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        return view('sanpham.create');
    }

    // Lưu sản phẩm mới vào CSDL
    public function store(Request $request)
    {
        // Xác thực dữ liệu, thêm trường mô tả sản phẩm
        $validatedData = $request->validate([
            'ten_sp' => 'required|string|max:150',
            'mo_ta_sp' => 'nullable|string|max:500',
            'gia_sp' => 'required|numeric|min:0',
            'so_luong_ton_sp' => 'required|integer|min:0',
            'hinh_anh_sp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Xử lý upload hình ảnh nếu có
        $imagePath = null;
        if ($request->hasFile('hinh_anh_sp')) {
            $imagePath = $request->file('hinh_anh_sp')->store('uploads', 'public');
        }

        // Tạo sản phẩm mới với dữ liệu đã xác thực
        SanPham::create([
            'ten_sp' => $validatedData['ten_sp'],
            'mo_ta_sp' => $validatedData['mo_ta_sp'], // Bổ sung mô tả
            'gia_sp' => $validatedData['gia_sp'],
            'so_luong_ton_sp' => $validatedData['so_luong_ton_sp'],
            'hinh_anh_sp' => $imagePath
        ]);

        // Chuyển hướng kèm thông báo
        return redirect('/san-pham')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $product = SanPham::findOrFail($id);
        return view('sanpham.edit', compact('product'));
    }

    // Cập nhật sản phẩm trong CSDL
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu, bổ sung kiểm tra trường mô tả
        $validatedData = $request->validate([
            'ten_sp' => 'required|string|max:150',
            'mo_ta_sp' => 'nullable|string|max:500',
            'gia_sp' => 'required|numeric|min:0',
            'so_luong_ton_sp' => 'required|integer|min:0',
            'hinh_anh_sp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = SanPham::findOrFail($id);

        // Xử lý ảnh mới nếu có và xóa ảnh cũ
        if ($request->hasFile('hinh_anh_sp')) {
            // Xóa ảnh cũ nếu có
            if ($product->hinh_anh_sp) {
                Storage::disk('public')->delete($product->hinh_anh_sp);
            }
            // Tải lên ảnh mới
            $imagePath = $request->file('hinh_anh_sp')->store('uploads', 'public');
            $product->hinh_anh_sp = $imagePath;
        }

        // Cập nhật thông tin sản phẩm (bao gồm mô tả)
        $product->update([
            'ten_sp' => $validatedData['ten_sp'],
            'mo_ta_sp' => $validatedData['mo_ta_sp'],
            'gia_sp' => $validatedData['gia_sp'],
            'so_luong_ton_sp' => $validatedData['so_luong_ton_sp'],
        ]);

        return redirect('/san-pham')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    // Xóa sản phẩm khỏi CSDL
    public function destroy($id)
    {
        $product = SanPham::findOrFail($id);

        // Xóa ảnh nếu tồn tại
        if ($product->hinh_anh_sp) {
            Storage::disk('public')->delete($product->hinh_anh_sp);
        }

        // Xóa sản phẩm khỏi CSDL
        $product->delete();

        return redirect('/san-pham')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
