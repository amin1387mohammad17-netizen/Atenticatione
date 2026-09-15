@extends('layouts.site')

@section('title', 'محصولات فروشگاه')

@push('styles')
<style>
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color var(--duration) ease-in-out;
    }
    .product-card:hover { border-color: var(--border-strong); }

    .product-card-image {
        aspect-ratio: 1 / 1;
        background: var(--elevated);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 13px;
        overflow: hidden;
    }
    .product-card-image img { width: 100%; height: 100%; object-fit: cover; }

    .product-card-body { padding: 14px; display: flex; flex-direction: column; gap: 6px; flex: 1; }
    .product-card-name { font-size: 14px; font-weight: 500; }
    .product-card-price { color: var(--primary-hover); font-size: 15px; font-weight: 600; margin-top: auto; }
    .product-card-stock { font-size: 12px; color: var(--muted); }

    .pagination-bar { margin-top: 28px; display: flex; justify-content: center; }
    .pagination-bar nav > div > div:first-child,
    .pagination-bar nav > div > p { color: var(--muted); font-size: 13px; }
    .pagination-bar a, .pagination-bar span {
        color: var(--text) !important;
    }
    .pagination-bar span[aria-current="page"] span {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }
    .pagination-bar a, .pagination-bar span span {
        background: var(--surface) !important;
        border-color: var(--border-strong) !important;
    }
</style>
@endpush

@section('content')
    <div class="page-heading">
        <h1>محصولات</h1>
        <p>مجموعه‌ی محصولات فروشگاه ما</p>
    </div>

    @if($products->isEmpty())
        <div class="empty-state">در حال حاضر محصولی برای نمایش وجود ندارد.</div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}" class="product-card">
                    <div class="product-card-image">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            بدون تصویر
                        @endif
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-name">{{ $product->name }}</div>
                        @if($product->stock > 0)
                            <div class="product-card-stock">موجود</div>
                        @else
                            <div class="product-card-stock" style="color: var(--primary-hover);">ناموجود</div>
                        @endif
                        <div class="product-card-price">{{ number_format($product->price) }} تومان</div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="pagination-bar">
            {{ $products->links() }}
        </div>
    @endif
@endsection
