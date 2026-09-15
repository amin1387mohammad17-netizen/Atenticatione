@extends('layouts.admin')

@section('title', 'افزودن ادمین جدید')
@section('page-title', 'افزودن ادمین جدید')
@section('page-subtitle', 'یک حساب کاربری با دسترسی پنل مدیریت بسازید')

@push('styles')
<style>
    .role-card {
        background: var(--elevated);
        border: 1px solid var(--border-strong);
        border-radius: var(--radius-lg);
        padding: 16px;
        transition: border-color var(--duration) ease-in-out;
    }
    .role-card.is-checked { border-color: var(--primary); }

    .role-card-head {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }
    .role-card-head label { font-size: 14px; font-weight: 500; }
    .role-description { color: var(--muted); font-size: 13px; margin: 0 0 12px; }

    .permission-group { margin-bottom: 12px; }
    .permission-group:last-child { margin-bottom: 0; }
    .permission-group-label {
        font-size: 12px;
        color: var(--muted);
        margin-bottom: 6px;
    }
    .permission-item {
        display: flex;
        align-items: center;
        gap: var(--space-1);
        font-size: 13px;
        color: var(--muted);
        padding: 3px 0;
    }

    .roles-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    @media (max-width: 767px) {
        .roles-grid { grid-template-columns: 1fr; }
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 24px;
    }
</style>
@endpush

@section('content')
    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="field">
                <label for="name">نام</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">ایمیل</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">رمز عبور</label>
                <input type="password" id="password" name="password" required>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field" style="margin-bottom: 0;">
                <label for="password_confirmation">تایید رمز عبور</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="card">
            <label style="display:block; font-size: 14px; margin-bottom: 16px;">نقش‌ها و دسترسی‌ها</label>

            <div class="roles-grid">
                @foreach($roles as $role)
                    <div class="role-card">
                        <div class="role-card-head">
                            <input type="checkbox" class="role-checkbox" name="roles[]"
                                   value="{{ $role->id }}" id="role_{{ $role->id }}"
                                   data-role-id="{{ $role->id }}">
                            <label for="role_{{ $role->id }}">{{ $role->display_name }}</label>
                        </div>

                        @if($role->description)
                            <p class="role-description">{{ $role->description }}</p>
                        @endif

                        @foreach($role->permissions->groupBy('group') as $group => $permissions)
                            <div class="permission-group">
                                <div class="permission-group-label">{{ $group ?? 'سایر' }}</div>
                                @foreach($permissions as $permission)
                                    <div class="permission-item">
                                        <input type="checkbox" disabled id="permission_{{ $role->id }}_{{ $permission->id }}">
                                        <label for="permission_{{ $role->id }}_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.admins.index') }}" class="btn btn-ghost">انصراف</a>
            <button type="submit" class="btn">ایجاد ادمین</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.role-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const roleId = this.dataset.roleId;
            const card = this.closest('.role-card');
            card.classList.toggle('is-checked', this.checked);

            card.querySelectorAll(`[id^="permission_${roleId}_"]`).forEach(function (permCheckbox) {
                permCheckbox.disabled = !checkbox.checked;
                if (!checkbox.checked) permCheckbox.checked = false;
            });
        });
    });
});
</script>
@endpush
