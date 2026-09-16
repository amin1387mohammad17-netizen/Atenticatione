@extends('layouts.site')

@section('title', $product->name)

@section('content')

    <a href="{{ route('products.index') }}" class="back-link">← بازگشت به محصولات</a>

    <div class="detail-grid">
        <div class="detail-image">
            @if($product->image)
                <img src="{{ asset('app/images/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                بدون تصویر
            @endif
        </div>

        <div>
            <h1 class="detail-name">{{ $product->name }}</h1>

            @if($product->stock > 0)
                <span class="stock-pill in-stock">موجود در انبار</span>
            @else
                <span class="stock-pill out-stock">ناموجود</span>
            @endif

            <div class="detail-price">
                {{ number_format($product->price) }}
                <small>تومان</small>
            </div>

            @if($product->description)
                <p class="detail-desc">{{ $product->description }}</p>
            @endif
        </div>
    </div>

@endsection