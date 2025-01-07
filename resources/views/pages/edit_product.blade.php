@extends('layouts.main')

@section('title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<h1>Chỉnh Sửa Sản Phẩm</h1>

<form action="/san-pham/sua/{{ $sanPham->id_sp }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="ten_sp">Tên Sản Phẩm:</label>
    <input type="text" name="ten_sp" value="{{ $sanPham->ten_sp }}" required><br><br>

    <label for="mo_ta_sp">Mô Tả Sản Phẩm:</label>
    <textarea name="mo_ta_sp">{{ $sanPham->mo_ta_sp }}</textarea><br><br>

    <label for="gia_sp">Giá:</label>
    <input type="number" name="gia_sp" value="{{ $sanPham->gia_sp }}" required><br><br>

    <label for="so_luong_ton_sp">Số Lượng Tồn Kho:</label>
    <input type="number" name="so_luong_ton_sp" value="{{ $sanPham->so_luong_ton_sp }}" required><br><br>

    <!-- Hiển thị ảnh cũ -->
    @if($sanPham->hinh_anh_sp)
    <p>Ảnh hiện tại:</p>
    <img src="{{ asset('storage/' . $sanPham->hinh_anh_sp) }}" alt="{{ $sanPham->ten_sp }}" style="width:100px;">
    @endif
    <br><br>

    <!-- Chọn ảnh mới -->
    <label for="hinh_anh_sp">Thay đổi ảnh (Tùy chọn):</label>
    <input type="file" name="hinh_anh_sp"><br><br>

    <button type="submit">Cập Nhật</button>
</form>
@endsection