@extends('layouts.admin')

@section('title', 'ویرایش ادمین')
@section('page-title', 'ویرایش ادمین')
@section('page-subtitle', $admin->name)

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
    @php
        $adminRoleIds = old('roles', $admin->roles->pluck('id')->all());
    @endphp

    <form action="{{ route('admin.admins.update', $admin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="field">
                <label for="name">نام</label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">ایمیل</label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">رمز عبور جدید</label>
                <input type="password" id="password" name="password">
                <div class="field-hint">خالی بگذارید تا رمز عبور فعلی تغییر نکند</div>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="field" style="margin-bottom: 0;">
                <label for="password_confirmation">تایید رمز عبور جدید</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

        @if(!$admin->isSuperAdmin())
        <div class="card">
            <div class="switch-row">
                <input type="checkbox" id="can_create_admins" name="can_create_admins" value="1"
                       {{ old('can_create_admins', $admin->can_create_admins) ? 'checked' : '' }}>
                <label for="can_create_admins">این ادمین اجازه‌ی افزودن ادمین جدید را داشته باشد</label>
            </div>
            <div class="field-hint" style="margin-top: 8px;">
                فقط مدیر کل می‌تواند این دسترسی را بدهد. ویرایش و حذف ادمین‌ها همیشه فقط در اختیار مدیر کل باقی می‌ماند.
            </div>
        </div>
        @endif

        <div class="card">
            <label style="display:block; font-size: 14px; margin-bottom: 16px;">نقش‌ها و دسترسی‌ها</label>

            <div class="roles-grid">
                @foreach($roles as $role)
                    @php $isChecked = in_array($role->id, $adminRoleIds); @endphp
                    <div class="role-card {{ $isChecked ? 'is-checked' : '' }}">
                        <div class="role-card-head">
                            <input type="checkbox" class="role-checkbox" name="roles[]"
                                   value="{{ $role->id }}" id="role_{{ $role->id }}"
                                   data-role-id="{{ $role->id }}"
                                   {{ $isChecked ? 'checked' : '' }}>
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
                                        <input type="checkbox" {{ $isChecked ? 'checked' : '' }} {{ $isChecked ? '' : 'disabled' }}
                                               id="permission_{{ $role->id }}_{{ $permission->id }}">
                                        <label for="permission_{{ $role->id }}_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            @error('roles') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.admins.index') }}" class="btn btn-ghost">انصراف</a>
            <button type="submit" class="btn">بروزرسانی ادمین</button>
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
