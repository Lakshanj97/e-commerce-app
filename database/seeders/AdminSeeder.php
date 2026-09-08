<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);

        // 1. Super Admin Account
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@simplytek.com'],
            [
                'name' => 'Super Admin',
                'first_name' => 'SimplyTek',
                'last_name' => 'Admin',
                'phone' => '+94771234567',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );
        if (! $superAdmin->hasRole($superAdminRole->name)) {
            $superAdmin->assignRole($superAdminRole);
        }

        // 2. Secondary Admin / Manager Account
        $admin = User::firstOrCreate(
            ['email' => 'manager@simplytek.com'],
            [
                'name' => 'Store Manager',
                'first_name' => 'Store',
                'last_name' => 'Manager',
                'phone' => '+94777654321',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );
        if (! $admin->hasRole($adminRole->name)) {
            $admin->assignRole($adminRole);
        }

        // 3. Sample Customer Account
        $customer = User::firstOrCreate(
            ['email' => 'customer@simplytek.com'],
            [
                'name' => 'Sample Customer',
                'first_name' => 'Sample',
                'last_name' => 'Customer',
                'phone' => '+94779876543',
                'password' => Hash::make('Customer@12345'),
                'email_verified_at' => now(),
            ]
        );
        if (! $customer->hasRole($customerRole->name)) {
            $customer->assignRole($customerRole);
        }
    }
}
