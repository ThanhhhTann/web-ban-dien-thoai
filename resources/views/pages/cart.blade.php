@extends('layouts.main')

@section('title', 'Giỏ Hàng')

@section('content')
<h1>Giỏ Hàng Của Bạn</h1>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

@if(count($cart) > 0)
<ul>
    @foreach($cart as $id => $item)
    <li>
        <strong>{{ $item['ten_sp'] }}</strong><br>
        Giá: {{ number_format($item['gia_sp']) }} VND<br>
        Số lượng: {{ $item['so_luong'] }}<br>

        <!-- Ảnh sản phẩm -->
        @if($item['hinh_anh_sp'])
        <img src="{{ asset('storage/' . $item['hinh_anh_sp']) }}" style="width:100px;">
        @endif
        <br>

        <!-- Nút xóa sản phẩm -->
        <form action="/gio-hang/xoa/{{ $id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="color: red; border: none; background: none;">Xóa</button>
        </form>
    </li>
    <hr>
    @endforeach
</ul>

<!-- Thanh Toán -->
<form action="/gio-hang/thanh-toan" method="POST">
    @csrf
    <button type="submit" style="padding: 10px; background: orange; color: white;">Thanh Toán</button>
</form>
@else
<p>Giỏ hàng của bạn đang trống.</p>
@endif

<a href="/san-pham">Quay lại mua sắm</a>
@endsection