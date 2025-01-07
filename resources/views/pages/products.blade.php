@extends('layouts.main')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
<h1>Danh Sách Sản Phẩm</h1>

<!-- Hiển thị Thông Báo Thành Công -->
@if(session('success'))
<div style="color: green;">
    {{ session('success') }}
</div>
@endif

<!-- Nút Thêm Sản Phẩm -->
<a href="/san-pham/them" style="padding: 10px; background: green; color: white; text-decoration: none; border-radius: 5px;">
    + Thêm Sản Phẩm
</a>
<br><br>

<!-- Bắt Đầu Hiển Thị Sản Phẩm -->
<ul>
    @foreach($sanPhams as $sp)
    <li style="border: 1px solid #ddd; padding: 10px; margin-bottom: 15px;">
        <strong>{{ $sp->ten_sp }}</strong><br>
        Giá: <span style="color: green;">{{ number_format($sp->gia_sp) }} VND</span><br>
        <p>{{ $sp->mo_ta_sp }}</p>

        <!-- Hiển Thị Ảnh Sản Phẩm -->
        @if($sp->hinh_anh_sp)
        <img src="{{ asset('storage/' . $sp->hinh_anh_sp) }}" alt="{{ $sp->ten_sp }}" style="width:100px; height:100px;">
        @else
        <p><i>Không có hình ảnh</i></p>
        @endif
        <br>

        <!-- Nút Chỉnh Sửa -->
        <a href="/san-pham/sua/{{ $sp->id_sp }}" style="color: blue; text-decoration: none; margin-right: 10px;">Sửa</a>

        <!-- Form Xóa -->
        <form action="/san-pham/xoa/{{ $sp->id_sp }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="color: red; border: none; background: none; cursor: pointer;">Xóa</button>
        </form>

        <!-- Thêm Nút Thêm Vào Giỏ Hàng -->
        <form action="/gio-hang/them/{{ $sp->id_sp }}" method="POST" style="display:inline; margin-left: 10px;">
            @csrf
            <button type="submit" style="padding: 5px 10px; background: orange; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Thêm Vào Giỏ Hàng
            </button>
        </form>
    </li>
    @endforeach
</ul>

<!-- Nút Chuyển Đến Giỏ Hàng -->
<a href="/gio-hang" style="padding: 10px; background: blue; color: white; text-decoration: none; border-radius: 5px;">
    Xem Giỏ Hàng
</a>
@endsection