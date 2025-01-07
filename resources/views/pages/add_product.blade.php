@extends('layouts.main')

@section('title', 'Thêm Sản Phẩm')

@section('content')
<h1>Thêm Sản Phẩm Mới</h1>

<!-- Hiển thị lỗi -->
@if ($errors->any())
<div style="color: red;">
    <p><strong>Lỗi:</strong></p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Hiển thị thông báo thành công -->
@if (session('success'))
<div style="color: green;">
    <p>{{ session('success') }}</p>
</div>
@endif

<!-- Form thêm sản phẩm -->
<form action="/san-pham/them" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="ten_sp">Tên Sản Phẩm:</label><br>
    <input type="text" name="ten_sp" required><br><br>

    <label for="mo_ta_sp">Mô Tả:</label><br>
    <textarea name="mo_ta_sp"></textarea><br><br>

    <label for="gia_sp">Giá:</label><br>
    <input type="number" name="gia_sp" required><br><br>

    <label for="so_luong_ton_sp">Số Lượng:</label><br>
    <input type="number" name="so_luong_ton_sp" required><br><br>

    <label for="hinh_anh_sp">Hình Ảnh:</label><br>
    <input type="file" name="hinh_anh_sp"><br><br>

    <button type="submit">Thêm Sản Phẩm</button>
</form>
@endsection