@extends('layouts.admin')

@section('title', 'ویرایش محصول')
@section('page-title', 'ویرایش محصول')
@section('page-subtitle', $product->name)

@section('content')
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="field">
                <label for="name">نام محصول</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="description">توضیحات</label>
                <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="field">
                    <label for="price">قیمت (تومان)</label>
                    <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                    @error('price') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="stock">موجودی</label>
                    <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="field">
                <label for="image">تصویر محصول</label>
                @if($product->image)
                    <div class="field-current-image">
                        <img src="{{ asset('app/images/' . $product->image) }}" alt="{{ $product->name }}" class="thumb">
                        <span class="field-hint">تصویر فعلی — برای تغییر، فایل جدید انتخاب کنید</span>
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                @error('image') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="switch-row">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <label for="is_active">این محصول در فروشگاه نمایش داده شود</label>
            </div>
        </div>

        <div class="form-actions" style="display:flex; justify-content: space-between; margin-top: 24px;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">انصراف</a>
            <button type="submit" class="btn">بروزرسانی محصول</button>
        </div>
    </form>
@endsection
