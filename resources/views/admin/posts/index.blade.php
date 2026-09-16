@extends('layouts.admin')

@section('title', 'لیست مطالب')
@section('page-title', 'لیست مطالب')
@section('page-subtitle', 'مطالب و اخبار فروشگاه را مدیریت کنید')

@section('page-actions')
    <a href="{{ route('admin.posts.create') }}" class="btn">افزودن مطلب</a>
@endsection

@section('content')
    <div class="card" style="padding: 0; overflow: hidden;">
        @if($posts->isEmpty())
            <div class="empty-state">هنوز هیچ مطلبی ثبت نشده. از دکمه‌ی «افزودن مطلب» شروع کنید.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>تاریخ انتشار</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('app/images/' . $post->image) }}" alt="{{ $post->title }}" class="thumb">
                            @else
                                <span class="thumb-placeholder">—</span>
                            @endif
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if($post->is_published)
                                <span class="status-pill is-on">منتشرشده</span>
                            @else
                                <span class="status-pill is-off">پیش‌نویس</span>
                            @endif
                        </td>
                        <td style="color: var(--muted);">
                            {{ $post->published_at?->format('Y/m/d') ?? '—' }}
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-ghost btn-sm">ویرایش</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                      onsubmit="return confirm('آیا از حذف این مطلب مطمئن هستید؟')">
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
