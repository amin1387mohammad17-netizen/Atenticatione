@extends('layouts.site')

@section('title', 'محصولات فروشگاه')
@section('banner-title', 'محصولات')
@section('banner-breadcrumb', 'همه محصولات')

@section('content')

    <div class="shop-toolbar">
        <span class="results-count">نمایش {{ $products->count() }} از {{ $products->total() }} محصول</span>
        <span class="sort-label">مرتب‌سازی: <b>جدیدترین</b></span>
    </div>

    <div class="shop-grid">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product) }}" class="shop-card">

                <div class="shop-card-media">
                    @if($product->image)
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

                <div class="shop-card-stock {{ $product->stock > 0 ? '' : 'is-out' }}">
                    {{ $product->stock > 0 ? 'موجود' : 'ناموجود' }}
                </div>

                <div class="shop-card-price">
                    {{ number_format($product->price) }}
                    <small>تومان</small>
                </div>

            </a>
        @empty
            <div class="empty-state">در حال حاضر محصولی برای نمایش وجود ندارد.</div>
        @endforelse
    </div>

    @if($products->hasPages())
        <div class="pagination-bar">
            {{ $products->links() }}
        </div>
    @endif

@endsection