@extends('layouts.app')

@section('title', 'Danh Sách Sản Phẩm')

@section('content')
<h1>Danh Sách Sản Phẩm</h1>
<a href="/san-pham/create">➕ Thêm Sản Phẩm</a>

<!-- Form tìm kiếm -->
<form action="/san-pham" method="GET" style="margin-top: 20px; margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ $search ?? '' }}">
    <button type="submit">🔍 Tìm Kiếm</button>
</form>

<!-- Thông báo khi có kết quả hoặc không -->
@if ($products->count() > 0)
<p>Đang hiển thị {{ $products->count() }} sản phẩm</p>
@else
<p style="color: red;">Không tìm thấy sản phẩm nào phù hợp với từ khóa: <strong>{{ $search }}</strong></p>
@endif

<!-- Hiển thị sản phẩm -->
<div class="product-list">
    @foreach($products as $product)
    <div class="product-item" style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
        @if($product->hinh_anh_sp)
        <img src="{{ asset('storage/' . $product->hinh_anh_sp) }}" alt="{{ $product->ten_sp }}" style="width:150px;">
        @endif
        <h3>{{ $product->ten_sp }}</h3>
        <p>Mô Tả: {{ $product->mo_ta_sp }}</p>
        <p>Giá: {{ number_format($product->gia_sp, 0, ',', '.') }} VND</p>
        <p>Số lượng tồn: {{ $product->so_luong_ton_sp }}</p>

        <!-- Nút chỉnh sửa -->
        <a href="/san-pham/{{ $product->id_sp }}/edit">✏️ Chỉnh Sửa</a>

        <!-- Nút xóa sản phẩm -->
        <form action="/san-pham/{{ $product->id_sp }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑️ Xóa</button>
        </form>
        <form action="{{ route('cart.add', $product->id_sp) }}" method="POST">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <button type="submit">🛒 Thêm vào giỏ hàng</button>
        </form>

    </div>
    @endforeach
</div>

<!-- Phân Trang -->
<div style="margin-top: 20px;">
    {{ $products->appends(['search' => request()->search])->links() }}
</div>
@endsection