<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mobile Phones & Tablets',
                'slug' => 'mobile-phones-tablets',
                'children' => [
                    ['name' => 'Smartphones', 'slug' => 'smartphones'],
                    ['name' => 'Tablets & iPads', 'slug' => 'tablets-ipads'],
                    ['name' => 'Phone Accessories', 'slug' => 'phone-accessories'],
                ],
            ],
            [
                'name' => 'Smart Watches & Wearables',
                'slug' => 'smart-watches-wearables',
                'children' => [
                    ['name' => 'Smart Watches', 'slug' => 'smart-watches'],
                    ['name' => 'Fitness Bands', 'slug' => 'fitness-bands'],
                ],
            ],
            [
                'name' => 'Audio & Sound',
                'slug' => 'audio-sound',
                'children' => [
                    ['name' => 'Wireless Earbuds', 'slug' => 'wireless-earbuds'],
                    ['name' => 'Headphones', 'slug' => 'headphones'],
                    ['name' => 'Bluetooth Speakers', 'slug' => 'bluetooth-speakers'],
                ],
            ],
            [
                'name' => 'Power & Charging',
                'slug' => 'power-charging',
                'children' => [
                    ['name' => 'Power Banks', 'slug' => 'power-banks'],
                    ['name' => 'Fast Chargers', 'slug' => 'fast-chargers'],
                    ['name' => 'Charging Cables', 'slug' => 'charging-cables'],
                ],
            ],
            [
                'name' => 'Smart Devices & Gadgets',
                'slug' => 'smart-devices-gadgets',
                'children' => [
                    ['name' => 'Smart Home', 'slug' => 'smart-home'],
                    ['name' => 'Security Cameras', 'slug' => 'security-cameras'],
                    ['name' => 'Projectors', 'slug' => 'projectors'],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $parent = Category::firstOrCreate(
                ['slug' => $catData['slug']],
                [
                    'name' => $catData['name'],
                    'parent_id' => null,
                    'status' => true,
                ]
            );

            if (isset($catData['children'])) {
                foreach ($catData['children'] as $childData) {
                    Category::firstOrCreate(
                        ['slug' => $childData['slug']],
                        [
                            'name' => $childData['name'],
                            'parent_id' => $parent->id,
                            'status' => true,
                        ]
                    );
                }
            }
        }
    }
}
