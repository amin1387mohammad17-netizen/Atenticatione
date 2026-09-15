@extends('layouts.admin')

@section('title', 'افزودن مطلب')
@section('page-title', 'افزودن مطلب')
@section('page-subtitle', 'یک مطلب یا خبر جدید منتشر کنید')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="field">
                <label for="title">عنوان</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="excerpt">خلاصه</label>
                <textarea id="excerpt" name="excerpt" style="min-height: 60px;">{{ old('excerpt') }}</textarea>
                <div class="field-hint">یک یا دو جمله‌ی کوتاه که در لیست مطالب نشان داده می‌شود</div>
                @error('excerpt') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="content">متن مطلب</label>
                <textarea id="content" name="content" style="min-height: 220px;">{{ old('content') }}</textarea>
                @error('content') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="image">تصویر شاخص</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="switch-row">
                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                <label for="is_published">این مطلب منتشر شود</label>
            </div>
        </div>

        <div class="form-actions" style="display:flex; justify-content: space-between; margin-top: 24px;">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-ghost">انصراف</a>
            <button type="submit" class="btn">ایجاد مطلب</button>
        </div>
    </form>
@endsection
