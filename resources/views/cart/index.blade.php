@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
<h1>Giỏ Hàng</h1>

@if(session('success'))
<p style="color: green">{{ session('success') }}</p>
@endif

<!-- Kiểm tra nếu giỏ hàng có sản phẩm -->
@if($cartItems->count() > 0)
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Tên Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Tổng</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>
                @if($item->attributes['hinh_anh_sp'])
                <img src="{{ asset('storage/' . $item->attributes['hinh_anh_sp']) }}" width="80">
                @endif
            </td>
            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
            <td>
                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                    <button type="submit">Cập Nhật</button>
                </form>
            </td>
            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
            <td>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit">🗑️ Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<p><strong>Tổng Cộng: </strong> {{ number_format(Cart::getTotal(), 0, ',', '.') }} VND</p>

<form action="{{ route('cart.clear') }}" method="POST">
    @csrf
    <button type="submit">🗑️ Xóa Toàn Bộ Giỏ Hàng</button>
</form>
@else
<p style="color: red;">Giỏ hàng của bạn đang trống!</p>
@endif
@endsection