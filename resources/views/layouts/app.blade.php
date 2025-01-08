<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.header') <!-- Đảm bảo gọi đúng -->

    <main>
        @yield('content')
    </main>

    @include('layouts.footer') <!-- Đảm bảo gọi đúng -->
</body>

</html>