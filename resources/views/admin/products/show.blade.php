@extends('layouts.site')

@section('title', $product->name)

@push('styles')
<style>
    .product-detail {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        align-items: start;
    }
    @media (max-width: 767px) {
        .product-detail { grid-template-columns: 1fr; }
    }

    .product-detail-image {
        aspect-ratio: 1 / 1;
        background: var(--elevated);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        overflow: hidden;
    }
    .product-detail-image img { width: 100%; height: 100%; object-fit: cover; }

    .product-detail-name { font-size: 22px; font-weight: 600; margin: 0 0 8px; }
    .product-detail-price { font-size: 24px; font-weight: 700; color: var(--primary-hover); margin: 12px 0; }
    .product-detail-desc { color: var(--muted); line-height: 1.9; font-size: 14px; margin-bottom: 20px; }

    .back-link { display: inline-block; margin-bottom: 20px; color: var(--muted); font-size: 14px; }
    .back-link:hover { color: var(--text); }
</style>
@endpush

@section('content')
    <a href="{{ route('products.index') }}" class="back-link">← بازگشت به محصولات</a>

    <div class="product-detail">
        <div class="product-detail-image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                بدون تصویر
            @endif
        </div>

        <div>
            <h1 class="product-detail-name">{{ $product->name }}</h1>

            @if($product->stock > 0)
                <span class="status-pill" style="background: rgba(40,167,69,0.15); color:#6fd08c; padding:2px 8px; border-radius:999px; font-size:12px;">موجود در انبار</span>
            @else
                <span class="status-pill" style="background: rgba(220,53,69,0.15); color:#E35D6A; padding:2px 8px; border-radius:999px; font-size:12px;">ناموجود</span>
            @endif

            <div class="product-detail-price">{{ number_format($product->price) }} تومان</div>

            @if($product->description)
                <p class="product-detail-desc">{{ $product->description }}</p>
            @endif
        </div>
    </div>
@endsection
