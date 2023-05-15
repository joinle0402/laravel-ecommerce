<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Admin',
                'group' => 'system',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'group' => 'system',
                'guard_name' => 'web',
            ],
            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'group' => 'system',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'group' => 'system',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'group' => 'system',
                'guard_name' => 'web',
            ],
        ];

        Role::insert($roles);
    }
}
