<?php

// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereHas('roles')->with('roles.permissions')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        abort_unless(auth()->user()->canCreateAdmins(), 403, 'شما دسترسی افزودن ادمین جدید را ندارید');

        $roles = Role::with('permissions')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->canCreateAdmins(), 403, 'شما دسترسی افزودن ادمین جدید را ندارید');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->roles()->attach($validated['roles']);

        return redirect()->route('admin.admins.index')
            ->with('success', 'ادمین با موفقیت ایجاد شد');
    }

    public function edit(User $admin)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'فقط مدیر کل می‌تواند ادمین‌ها را ویرایش کند');

        $roles = Role::with('permissions')->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, User $admin)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'فقط مدیر کل می‌تواند ادمین‌ها را ویرایش کند');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'can_create_admins' => $request->boolean('can_create_admins'),
        ]);

        if (!empty($validated['password'])) {
            $admin->update(['password' => Hash::make($validated['password'])]);
        }

        $admin->roles()->sync($validated['roles']);

        return redirect()->route('admin.admins.index')
            ->with('success', 'اطلاعات ادمین بروزرسانی شد');
    }

    public function destroy(User $admin)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403, 'فقط مدیر کل می‌تواند ادمین حذف کند');

        if ($admin->id === auth()->id()) {
            abort(403, 'نمی‌توانید حساب خودتان را حذف کنید');
        }

        $admin->roles()->detach();
        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'ادمین حذف شد');
    }
}
