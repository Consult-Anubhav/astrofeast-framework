<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Arrays
        $roles = [
            'Admin',
            'Vice President',
            'Manager',
            'Business Analyst',
            'Executive',
            'Content Writer',
            'Accountant'
        ];

        $modules = [
            'Admin',
            'Human Resource',
            'Customers',
            'Products',
            'Orders',
            'Accounting',
            'Taxes & Currency Exchange',
            'Warehouse',
            'Marketing and Blogs'
        ];

        $module_permissions = [
            [1],
            [1],
            [2, 3, 4, 5, 6, 7, 8],
            [5, 6, 7, 8],
            [5, 8],
            [9],
            [6, 7]
        ];

        $users = [
            [
                'name' => 'Admin',
                'email' => 'tech@astrofeast.com',
                'password' => 'Astrofeast@2023',
                'is_admin' => 1,
                'is_active' => 1,
                'roles' => [1]
            ],
            [
                'name' => 'Sachin Bhoi',
                'email' => 'givesachin@gmail.com',
                'password' => 'Astrofeast@2023',
                'is_admin' => 1,
                'is_active' => 1,
                'roles' => [1, 3, 5]
            ],
            [
                'name' => 'Arya Thakor',
                'email' => 'thakoraarya@gmail.com',
                'password' => 'Astrofeast@2023',
                'is_admin' => 1,
                'is_active' => 0,
                'roles' => [1, 6]
            ],
            [
                'name' => 'Nisha Desai',
                'email' => 'nddesai97@gmail.com',
                'password' => 'Astrofeast@2023',
                'is_admin' => 1,
                'is_active' => 0,
                'roles' => [1, 5]
            ],
            [
                'name' => 'Ajay Kumar',
                'email' => 'ajsnp007@gmail.com',
                'password' => 'Astrofeast@2023',
                'is_admin' => 1,
                'is_active' => 0,
                'roles' => [1, 5]
            ]
        ];

        // Seed Roles
        foreach ($roles as $key => $role) {
            $role_name = new Role();

            $role_name->title = $role;
            $role_name->is_active = 1;
            $role_name->level = $key + 1;

            $role_name->save();
        }

        // Seed Users
        foreach ($users as $user) {
            $user_row = User::where('email', '=', $user['email'])->first();

            if (!$user_row)
                $user_row = new User();

            $user_row->name = $user['name'];
            $user_row->email = $user['email'];
            $user_row->password = bcrypt($user['password']);
            $user_row->is_admin = $user['is_admin'];
            $user_row->is_active = $user['is_active'];
            $user_row->type = 'admin';

            $user_row->save();

            foreach ($user['roles'] as $role_id) {
                $role_name = Role::where('title', '=', $roles[$role_id - 1])->first();

                if (!$role_name)
                    $role_name = new Role();

                $role_name->title = $roles[$role_id - 1];
                $role_name->is_active = 1;

                $role_name->save();

                UserRole::updateOrCreate([
                    'role_id' => $role_name->id,
                    'user_id' => $user_row->id
                ]);
            }
        }

        // Seed Modules
        foreach ($modules as $module) {
            $module_row = Module::where('title', '=', $module)->first();

            if (!$module_row)
                $module_row = new Module();

            $module_row->title = $module;
            $module_row->slug = Str::slug($module, '-');
            $module_row->is_active = 1;

            $module_row->save();
        }

        // Seed Module Permissions
        foreach ($module_permissions as $key => $role_modules) {
            foreach ($role_modules as $module_permission) {
                $module_permission_row = ModulePermission::where('module_id', '=', $module_permission)
                    ->where('role_id', '=', $key + 1)
                    ->first();

                if (!$module_permission_row)
                    $module_permission_row = new ModulePermission();

                $module_permission_row->role_id = $key + 1;
                $module_permission_row->module_id = $module_permission;

                $module_permission_row->save();
            }
        }
    }
}
