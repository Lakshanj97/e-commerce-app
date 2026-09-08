<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view orders',
            'manage orders',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $staff = Role::firstOrCreate(['name' => 'Staff']);
        $customer = Role::firstOrCreate(['name' => 'Customer']);

        // Assign permissions
        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view orders',
            'manage orders',
        ]);

        $staff->syncPermissions([
            'view products',
            'view orders',
            'manage orders',
        ]);
    }
}
