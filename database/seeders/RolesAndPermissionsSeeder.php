<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // ایجاد دسترسی‌ها
        $permissions = [
            ['name' => 'manage-users', 'display_name' => 'مدیریت کاربران', 'group' => 'users'],
            ['name' => 'manage-roles', 'display_name' => 'مدیریت نقش‌ها', 'group' => 'roles'],
            ['name' => 'manage-products', 'display_name' => 'مدیریت محصولات', 'group' => 'content'],
            ['name' => 'manage-posts', 'display_name' => 'مدیریت مطالب', 'group' => 'content'],
            ['name' => 'manage-comments', 'display_name' => 'مدیریت نظرات', 'group' => 'content'],
            ['name' => 'view-reports', 'display_name' => 'مشاهده گزارش‌ها', 'group' => 'reports'],
            ['name' => 'manage-settings', 'display_name' => 'مدیریت تنظیمات', 'group' => 'settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // ایجاد نقش‌ها
        $superAdmin = Role::firstOrCreate(
            ['name' => 'super-admin'],
            ['display_name' => 'مدیر کل', 'description' => 'دسترسی کامل به تمام بخش‌ها']
        );

        $admin = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'مدیر', 'description' => 'دسترسی به اکثر بخش‌ها']
        );

        $moderator = Role::firstOrCreate(
            ['name' => 'moderator'],
            ['display_name' => 'ناظر', 'description' => 'دسترسی محدود']
        );

        // دادن تمام دسترسی‌ها به super-admin
        $superAdmin->permissions()->sync(Permission::all());

        // دادن دسترسی‌های محدود به admin
        $admin->permissions()->sync(Permission::where('name', '!=', 'manage-roles')->pluck('id'));

        // دادن دسترسی‌های محدود به moderator
        $moderator->permissions()->sync(Permission::whereIn('name', ['manage-products', 'manage-posts', 'manage-comments'])->pluck('id'));

        // ایجاد کاربر super-admin
        $user = User::firstOrCreate(
            ['email' => 'amin1387mihammad17@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
            ]
        );

        if (!$user->hasRole('super-admin')) {
            $user->assignRole('super-admin');
        }
    }
}
