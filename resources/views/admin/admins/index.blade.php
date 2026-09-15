@extends('layouts.admin')

@section('title', 'لیست ادمین‌ها')
@section('page-title', 'لیست ادمین‌ها')
@section('page-subtitle', 'حساب‌های دارای دسترسی به پنل مدیریت')

@section('page-actions')
    @if(auth()->user()->canCreateAdmins())
        <a href="{{ route('admin.admins.create') }}" class="btn">افزودن ادمین جدید</a>
    @endif
@endsection

@section('content')
    <div class="card" style="padding: 0; overflow: hidden;">
        @if($admins->isEmpty())
            <div class="empty-state">هنوز هیچ ادمینی ثبت نشده. از دکمه‌ی «افزودن ادمین جدید» شروع کنید.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش‌ها</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td style="color: var(--muted);">{{ $admin->email }}</td>
                        <td>
                            @foreach($admin->roles as $role)
                                <span class="pill">{{ $role->display_name }}</span>
                            @endforeach
                            @if($admin->can_create_admins)
                                <span class="pill" style="background: rgba(40,167,69,0.15); color:#6fd08c;">مجاز به افزودن ادمین</span>
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->isSuperAdmin())
                                <div class="row-actions">
                                    <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-ghost btn-sm">ویرایش</a>
                                    @if($admin->id !== auth()->id())
                                        <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST"
                                              onsubmit="return confirm('آیا مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-ghost btn-sm" style="color: #E35D6A; border-color: rgba(220,53,69,0.35);">حذف</button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <span style="color: var(--muted); font-size: 13px;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
