@extends('layouts.app')

@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
<h1>Thêm Sản Phẩm Mới</h1>

@if (session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif

<form action="/san-pham" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="ten_sp">Tên Sản Phẩm:</label>
    <input type="text" name="ten_sp" required><br><br>

    <label for="mo_ta_sp">Mô Tả Sản Phẩm:</label>
    <textarea name="mo_ta_sp" rows="4" cols="50"></textarea><br><br>

    <label for="gia_sp">Giá Sản Phẩm:</label>
    <input type="number" name="gia_sp" required><br><br>

    <label for="so_luong_ton_sp">Số Lượng Tồn Kho:</label>
    <input type="number" name="so_luong_ton_sp" required><br><br>

    <label for="hinh_anh_sp">Hình Ảnh:</label>
    <input type="file" name="hinh_anh_sp"><br><br>

    <button type="submit">Thêm Sản Phẩm</button>
</form>
@endsection