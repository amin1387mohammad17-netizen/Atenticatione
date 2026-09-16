@extends('layouts.site')

@section('title', 'فروشگاه من | بهترین محصولات با بهترین کیفیت')
@section('banner-title', 'فروشگاه')
@section('banner-breadcrumb', 'محصولات فروشگاه')

@section('content')

    <div class="shop-toolbar">
        <span class="results-count">نمایش {{ $products->count() }} محصول</span>
        <span class="sort-label">مرتب‌سازی: <b>جدیدترین</b></span>
    </div>

    <div class="shop-grid">

        @forelse ($products as $product)

            <a href="{{ route('products.show', $product) }}" class="shop-card">

                <div class="shop-card-media">

                    @if ($loop->first)
                        <span class="shop-badge is-new"><span class="dot"></span>جدید</span>
                    @endif

                    @if ($product->image)
                        <img src="{{ asset('app/images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="no-image">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span>بدون تصویر</span>
                        </div>
                    @endif

                </div>

                <h3 class="shop-card-name">{{ $product->name }}</h3>

                <div class="shop-card-stars">
                    <span class="stars">
                        @for ($i = 0; $i < 5; $i++)
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        @endfor
                    </span>
                    <span class="count">(۴.۸)</span>
                </div>

                <div class="shop-card-price">
                    {{ number_format($product->price) }}
                    <small>تومان</small>
                </div>

            </a>

        @empty

            <div class="empty">
                <div class="empty-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                </div>
                <h3>هنوز محصولی ثبت نشده است</h3>
                <p>برای شروع، از پنل مدیریت اولین محصول خود را اضافه کنید.</p>
                @auth
                    <a href="{{ route('admin.products.index') }}" class="btn">رفتن به پنل مدیریت</a>
                @endauth
            </div>

        @endforelse

    </div>

    <section class="newsletter">
        <div class="newsletter-content">
            <h3>از تخفیف‌ها باخبر شوید</h3>
            <p>ایمیل خود را وارد کنید تا از جدیدترین پیشنهادات و تخفیف‌های ویژه مطلع شوید.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault();">
                <input type="email" placeholder="ایمیل خود را وارد کنید..." required>
                <button type="submit">عضویت</button>
            </form>
        </div>
    </section>

@endsection