<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'فروشگاه من')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body>

@include('partials.header')

@hasSection('banner-title')
    <section class="shop-banner">
        <div class="container">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span>/</span>
                @yield('banner-breadcrumb', 'فروشگاه')
            </p>
            <h1>@yield('banner-title')</h1>
        </div>
    </section>
@endif

<main class="container">
    @yield('content')
</main>

@include('partials.footer')

@stack('scripts')
</body>
</html>