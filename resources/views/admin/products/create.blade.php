@extends('layouts.admin')

@section('title', 'افزودن محصول')
@section('page-title', 'افزودن محصول')
@section('page-subtitle', 'یک محصول جدید به فروشگاه اضافه کنید')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="field">
                <label for="name">نام محصول</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="description">توضیحات</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="field">
                    <label for="price">قیمت (تومان)</label>
                    <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="stock">موجودی</label>
                    <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                    @error('stock') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="field">
                <label for="image">تصویر محصول</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="switch-row">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">این محصول در فروشگاه نمایش داده شود</label>
            </div>
        </div>

        <div class="form-actions" style="display:flex; justify-content: space-between; margin-top: 24px;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">انصراف</a>
            <button type="submit" class="btn">ایجاد محصول</button>
        </div>
    </form>
@endsection
