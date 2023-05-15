<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create-user', 'display_name' => 'Create user', 'group' => 'user', 'guard_name' => 'web'],
            ['name' => 'update-user', 'display_name' => 'Update user', 'group' => 'user', 'guard_name' => 'web'],
            ['name' => 'delete-user', 'display_name' => 'Delete user', 'group' => 'user', 'guard_name' => 'web'],
            ['name' => 'show-user', 'display_name' => 'Show user', 'group' => 'user', 'guard_name' => 'web'],

            ['name' => 'create-role', 'display_name' => 'Create role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'update-role', 'display_name' => 'Update role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'delete-role', 'display_name' => 'Delete role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'show-role', 'display_name' => 'Show role', 'group' => 'role', 'guard_name' => 'web'],

            ['name' => 'create-category', 'display_name' => 'Create category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'update-category', 'display_name' => 'Update category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'delete-category', 'display_name' => 'Delete category', 'group' => 'category', 'guard_name' => 'web'],
            ['name' => 'show-category', 'display_name' => 'Show category', 'group' => 'category', 'guard_name' => 'web'],

            ['name' => 'create-product', 'display_name' => 'Create product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'update-product', 'display_name' => 'Update product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'delete-product', 'display_name' => 'Delete product', 'group' => 'product', 'guard_name' => 'web'],
            ['name' => 'show-product', 'display_name' => 'Show product', 'group' => 'product', 'guard_name' => 'web'],

            ['name' => 'create-coupon', 'display_name' => 'Create coupon', 'group' => 'coupon', 'guard_name' => 'web'],
            ['name' => 'update-coupon', 'display_name' => 'Update coupon', 'group' => 'coupon', 'guard_name' => 'web'],
            ['name' => 'delete-coupon', 'display_name' => 'Delete coupon', 'group' => 'coupon', 'guard_name' => 'web'],
            ['name' => 'show-coupon', 'display_name' => 'Show coupon', 'group' => 'coupon', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);
    }
}
