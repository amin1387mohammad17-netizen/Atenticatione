@extends('layouts.admin')

@section('title', 'لیست محصولات')
@section('page-title', 'لیست محصولات')
@section('page-subtitle', 'محصولات فروشگاه را مدیریت کنید')

@section('page-actions')
    <a href="{{ route('admin.products.create') }}" class="btn">افزودن محصول</a>
@endsection

@section('content')
    <div class="card" style="padding: 0; overflow: hidden;">
        @if($products->isEmpty())
            <div class="empty-state">هنوز هیچ محصولی ثبت نشده. از دکمه‌ی «افزودن محصول» شروع کنید.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام محصول</th>
                        <th>قیمت</th>
                        <th>موجودی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('app/images/' . $product->image) }}" alt="{{ $product->name }}" class="thumb">
                            @else
                                <span class="thumb-placeholder">—</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }} تومان</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->is_active)
                                <span class="status-pill is-on">فعال</span>
                            @else
                                <span class="status-pill is-off">غیرفعال</span>
                            @endif
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-ghost btn-sm">ویرایش</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color: #E35D6A; border-color: rgba(220,53,69,0.35);">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection