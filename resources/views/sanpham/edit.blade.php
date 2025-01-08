@extends('layouts.app')

@section('title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<h1>Chỉnh Sửa Sản Phẩm</h1>
<form action="/san-pham/{{ $product->id_sp }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="ten_sp">Tên Sản Phẩm:</label>
    <input type="text" name="ten_sp" value="{{ $product->ten_sp }}" required><br><br>

    <label for="mo_ta_sp">Mô Tả Sản Phẩm:</label>
    <textarea name="mo_ta_sp" rows="4" cols="50">{{ $product->mo_ta_sp }}</textarea><br><br>

    <label for="gia_sp">Giá:</label>
    <input type="number" name="gia_sp" value="{{ $product->gia_sp }}" required><br><br>

    <label for="so_luong_ton_sp">Số Lượng Tồn:</label>
    <input type="number" name="so_luong_ton_sp" value="{{ $product->so_luong_ton_sp }}" required><br><br>

    <label for="hinh_anh_sp">Hình Ảnh Sản Phẩm (Tải Lên Mới):</label>
    <input type="file" name="hinh_anh_sp"><br><br>

    @if($product->hinh_anh_sp)
    <p>Ảnh hiện tại:</p>
    <img src="{{ asset('storage/' . $product->hinh_anh_sp) }}" alt="{{ $product->ten_sp }}" style="width:150px;">
    @endif

    <button type="submit">Cập Nhật Sản Phẩm</button>
</form>
@endsection