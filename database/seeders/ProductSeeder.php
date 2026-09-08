<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Power & Charging
            [
                'name' => 'Anker Prime 27,650mAh Power Bank (250W)',
                'slug' => 'anker-prime-27650mah-power-bank-250w',
                'category_slug' => 'power-banks',
                'brand_slug' => 'anker',
                'short_description' => 'Ultra-high capacity 250W multi-device fast portable charger with smart digital display.',
                'description' => 'Equipped with Anker’s latest GaN technology, this 27,650mAh beast delivers up to 250W total output across 2 USB-C and 1 USB-A ports. Capable of charging a 16-inch MacBook Pro to 50% in just 28 minutes. Features real-time output and remaining battery stats on a built-in smart LCD screen.',
                'original_price' => 58000.00,
                'selling_price' => 52500.00,
                'quantity' => 25,
                'warranty' => '24 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1609592424361-b5e1cf5ca760?w=800&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Anker 737 Power Bank (PowerCore 24K)',
                'slug' => 'anker-737-power-bank-powercore-24k',
                'category_slug' => 'power-banks',
                'brand_slug' => 'anker',
                'short_description' => '140W two-way fast charging portable battery with smart interactive display.',
                'description' => 'Featuring Power Delivery 3.1 and bi-directional technology, quickly recharge the 24,000mAh battery or get a 140W ultra-powerful charge for high-demand laptops and phones.',
                'original_price' => 45000.00,
                'selling_price' => 41900.00,
                'quantity' => 18,
                'warranty' => '18 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1585338107529-13afc5f02586?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Ugreen Nexode 100W GaN 4-Port Fast Charger',
                'slug' => 'ugreen-nexode-100w-gan-fast-charger',
                'category_slug' => 'fast-chargers',
                'brand_slug' => 'ugreen',
                'short_description' => 'Compact 100W GaN desktop charger with 3 USB-C and 1 USB-A ports.',
                'description' => 'Charge up to 4 devices simultaneously with groundbreaking GaN II technology. Intelligently allocates power across connected laptops, tablets, and phones.',
                'original_price' => 19500.00,
                'selling_price' => 17200.00,
                'quantity' => 30,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Baseus Blade 100W Slim Laptop Power Bank',
                'slug' => 'baseus-blade-100w-slim-laptop-power-bank',
                'category_slug' => 'power-banks',
                'brand_slug' => 'baseus',
                'short_description' => 'Ultra-thin 18mm 20,000mAh portable charger engineered for laptops and tablets.',
                'description' => 'Slim briefcase-friendly design with dual Type-C 100W output and dual USB-A 30W ports. Digital status screen tracks remaining time and wattage.',
                'original_price' => 28000.00,
                'selling_price' => 24500.00,
                'quantity' => 14,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&auto=format&fit=crop&q=80',
                ],
            ],

            // Audio & Sound
            [
                'name' => 'Sony WH-1000XM5 Wireless Noise-Canceling Headphones',
                'slug' => 'sony-wh-1000xm5-wireless-noise-canceling-headphones',
                'category_slug' => 'headphones',
                'brand_slug' => 'sony',
                'short_description' => 'Industry-leading noise cancellation with 2 processors, 8 microphones, and 30-hour battery.',
                'description' => 'Magnificent sound engineered to perfection with the new Integrated Processor V1. Ultra-comfortable lightweight design with soft fit leather, crystal-clear hands-free calling, and Speak-to-Chat technology.',
                'original_price' => 135000.00,
                'selling_price' => 119000.00,
                'quantity' => 10,
                'warranty' => '12 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Apple AirPods Pro (2nd Generation) with USB-C',
                'slug' => 'apple-airpods-pro-2nd-generation-usb-c',
                'category_slug' => 'wireless-earbuds',
                'brand_slug' => 'apple',
                'short_description' => 'Up to 2x more Active Noise Cancellation, Adaptive Audio, and Transparency mode.',
                'description' => 'Powered by Apple H2 chip. Personalized Spatial Audio with dynamic head tracking places sound all around you. MagSafe Charging Case (USB-C) with Precision Finding and speaker.',
                'original_price' => 88000.00,
                'selling_price' => 79500.00,
                'quantity' => 20,
                'warranty' => '12 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Anker Soundcore Liberty 4 NC Earbuds',
                'slug' => 'anker-soundcore-liberty-4-nc-earbuds',
                'category_slug' => 'wireless-earbuds',
                'brand_slug' => 'anker',
                'short_description' => 'Reduce noise by up to 98.5% with high-res wireless audio and 50-hour playtime.',
                'description' => 'Adaptive ANC 2.0 real-time noise reduction, 11mm custom drivers with Hi-Res Wireless and LDAC technology, and 6 mics with AI algorithm for ultra-clear calls.',
                'original_price' => 29500.00,
                'selling_price' => 26500.00,
                'quantity' => 35,
                'warranty' => '18 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'JBL Charge 5 Portable Waterproof Speaker',
                'slug' => 'jbl-charge-5-portable-waterproof-speaker',
                'category_slug' => 'bluetooth-speakers',
                'brand_slug' => 'jbl',
                'short_description' => 'Bold JBL Original Pro Sound with IP67 waterproof rating and built-in powerbank.',
                'description' => 'Delivers an optimized long excursion driver, separate tweeter, and dual pumping JBL bass radiators. Up to 20 hours of playtime and built-in power bank to keep your devices charged all night.',
                'original_price' => 64000.00,
                'selling_price' => 58900.00,
                'quantity' => 15,
                'warranty' => '12 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'JBL Flip 6 Portable Bluetooth Speaker',
                'slug' => 'jbl-flip-6-portable-bluetooth-speaker',
                'category_slug' => 'bluetooth-speakers',
                'brand_slug' => 'jbl',
                'short_description' => 'Eco-friendly packaging with 2-way speaker system and IP67 dust/waterproof protection.',
                'description' => 'Louder, more powerful sound with 12 hours of playtime. Connect multiple compatible speakers with PartyBoost for room-filling sound.',
                'original_price' => 46000.00,
                'selling_price' => 39900.00,
                'quantity' => 22,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=800&auto=format&fit=crop&q=80',
                ],
            ],

            // Mobile Phones & Tablets
            [
                'name' => 'Apple iPhone 16 Pro Max 256GB',
                'slug' => 'apple-iphone-16-pro-max-256gb',
                'category_slug' => 'smartphones',
                'brand_slug' => 'apple',
                'short_description' => 'Titanium design with A18 Pro chip, Camera Control, 48MP Fusion camera, and Dolby Vision.',
                'description' => 'Super Retina XDR display with ProMotion up to 120Hz. Ceramic Shield front is 2x tougher than any smartphone glass. Massive leap in battery life for all-day heavy performance.',
                'original_price' => 485000.00,
                'selling_price' => 459000.00,
                'quantity' => 8,
                'warranty' => '12 Months Apple Care',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=800&auto=format&fit=crop&q=80',
                    'https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra 512GB (AI Phone)',
                'slug' => 'samsung-galaxy-s24-ultra-512gb',
                'category_slug' => 'smartphones',
                'brand_slug' => 'samsung',
                'short_description' => 'Galaxy AI integration with Titanium frame, 200MP camera, and built-in S Pen.',
                'description' => 'Unleash whole new levels of creativity and productivity with Galaxy AI. Live Translate, Circle to Search, Photo Assist, and Snapdragon 8 Gen 3 for Galaxy.',
                'original_price' => 445000.00,
                'selling_price' => 415000.00,
                'quantity' => 12,
                'warranty' => '12 Months Samsung Warranty',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Apple iPad Air 11-inch M2 128GB Wi-Fi',
                'slug' => 'apple-ipad-air-11-inch-m2-128gb',
                'category_slug' => 'tablets-ipads',
                'brand_slug' => 'apple',
                'short_description' => 'Incredible M2 performance with Liquid Retina display and Apple Pencil Pro support.',
                'description' => 'Stunning Liquid Retina display with P3 wide color and anti-reflective coating. Ultrafast Wi-Fi 6E, landscape 12MP front camera with Center Stage.',
                'original_price' => 245000.00,
                'selling_price' => 229000.00,
                'quantity' => 15,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800&auto=format&fit=crop&q=80',
                ],
            ],

            // Smart Watches & Wearables
            [
                'name' => 'Apple Watch Ultra 2 GPS + Cellular 49mm',
                'slug' => 'apple-watch-ultra-2-gps-cellular-49mm',
                'category_slug' => 'smart-watches',
                'brand_slug' => 'apple',
                'short_description' => 'Rugged aerospace-grade titanium case with precision dual-frequency GPS and up to 72h battery.',
                'description' => 'The ultimate sports and adventure watch. Powered by S9 SiP with Double Tap gesture, 3000 nits brightness, depth gauge and water temperature sensor.',
                'original_price' => 295000.00,
                'selling_price' => 275000.00,
                'quantity' => 6,
                'warranty' => '12 Months',
                'is_featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Samsung Galaxy Watch 6 Classic 47mm',
                'slug' => 'samsung-galaxy-watch-6-classic-47mm',
                'category_slug' => 'smart-watches',
                'brand_slug' => 'samsung',
                'short_description' => 'Rotating physical bezel, Sapphire Crystal glass, and advanced sleep coaching.',
                'description' => 'Iconic timeless design with 20% larger display and 30% slimmer rotating bezel. Track body composition, ECG, blood pressure, and workout performance.',
                'original_price' => 115000.00,
                'selling_price' => 98000.00,
                'quantity' => 14,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&auto=format&fit=crop&q=80',
                ],
            ],
            [
                'name' => 'Xiaomi Smart Band 8 Active',
                'slug' => 'xiaomi-smart-band-8-active',
                'category_slug' => 'fitness-bands',
                'brand_slug' => 'xiaomi',
                'short_description' => '1.47-inch TFT display, 50+ sports modes, and up to 14 days battery life.',
                'description' => 'Sleek 9.99mm ultra-slim body. All-day heart rate and blood oxygen SpO2 monitoring, sleep tracking, and 5ATM water resistance.',
                'original_price' => 11500.00,
                'selling_price' => 8900.00,
                'quantity' => 40,
                'warranty' => '6 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1576243345690-4e4b79b63288?w=800&auto=format&fit=crop&q=80',
                ],
            ],

            // Smart Devices & Gadgets
            [
                'name' => 'Xiaomi Smart Camera C400 2.5K Ultra-Clear',
                'slug' => 'xiaomi-smart-camera-c400-2-5k',
                'category_slug' => 'security-cameras',
                'brand_slug' => 'xiaomi',
                'short_description' => '4MP 2.5K HDR security camera with 360-degree pan-tilt-zoom and AI human detection.',
                'description' => 'Dual-motor pan-tilt zoom with 360 horizontal and 106 vertical viewing angle. Two-way real-time voice calls with smart noise reduction.',
                'original_price' => 18500.00,
                'selling_price' => 15900.00,
                'quantity' => 20,
                'warranty' => '12 Months',
                'is_featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=800&auto=format&fit=crop&q=80',
                ],
            ],
        ];

        foreach ($products as $pData) {
            $category = Category::where('slug', $pData['category_slug'])->first();
            $brand = Brand::where('slug', $pData['brand_slug'])->first();

            if (! $category || ! $brand) {
                continue;
            }

            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'name' => $pData['name'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'short_description' => $pData['short_description'],
                    'description' => $pData['description'],
                    'original_price' => $pData['original_price'],
                    'selling_price' => $pData['selling_price'],
                    'quantity' => $pData['quantity'],
                    'warranty' => $pData['warranty'],
                    'is_active' => true,
                    'is_featured' => $pData['is_featured'],
                ]
            );

            // Images
            foreach ($pData['images'] as $idx => $imgUrl) {
                ProductImage::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'image_path' => $imgUrl,
                    ],
                    [
                        'is_primary' => $idx === 0,
                    ]
                );
            }
        }
    }
}
