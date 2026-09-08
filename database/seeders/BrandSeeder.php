<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Anker', 'slug' => 'anker'],
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Sony', 'slug' => 'sony'],
            ['name' => 'JBL', 'slug' => 'jbl'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'Baseus', 'slug' => 'baseus'],
            ['name' => 'Ugreen', 'slug' => 'ugreen'],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(
                ['slug' => $brand['slug']],
                [
                    'name' => $brand['name'],
                    'logo_path' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}
