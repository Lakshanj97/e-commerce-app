<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'manage orders']);

        Permission::create(['name' => 'manage users']);

        // Roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $staff = Role::create(['name' => 'Staff']);
        $customer = Role::create(['name' => 'Customer']);

        // Assign permissions
        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view orders',
            'manage orders',
        ]);

        $staff->givePermissionTo([
            'view products',
            'view orders',
            'manage orders',
        ]);
    }
}
