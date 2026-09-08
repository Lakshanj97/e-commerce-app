<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'SimplyTek Electronics',
                'tax_number' => 'VAT-789456123',
                'address' => 'No. 123, Galle Road, Colombo 03, Sri Lanka',
                'phone' => '+94 11 234 5678',
                'email' => 'info@simplytek.com',
                'logo_path' => null,
            ]
        );
    }
}
