<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('email', 'customer@simplytek.com')->first();
        $products = Product::with('images')->where('is_active', true)->get();

        if ($products->isEmpty()) {
            return;
        }

        $sampleOrders = [
            [
                'order_number' => 'ST-2026-9025',
                'first_name' => 'Kasun',
                'last_name' => 'Perera',
                'email' => 'kasun.p@example.com',
                'phone' => '+94 77 234 5678',
                'address' => '45/2 Dharmapala Mawatha',
                'city' => 'Colombo 07',
                'postal_code' => '00700',
                'status' => 'pending',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'days_ago' => 0,
                'items' => [
                    ['slug' => 'anker-prime-27650mah-power-bank-250w', 'qty' => 1],
                    ['slug' => 'ugreen-nexode-100w-gan-fast-charger', 'qty' => 1],
                ],
            ],
            [
                'order_number' => 'ST-2026-9024',
                'first_name' => 'Sample',
                'last_name' => 'Customer',
                'email' => 'customer@simplytek.com',
                'phone' => '+94 77 987 6543',
                'address' => '12 Havelock Road',
                'city' => 'Colombo 05',
                'postal_code' => '00500',
                'status' => 'processing',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'days_ago' => 1,
                'items' => [
                    ['slug' => 'sony-wh-1000xm5-wireless-noise-canceling-headphones', 'qty' => 1],
                ],
            ],
            [
                'order_number' => 'ST-2026-9023',
                'first_name' => 'Nimal',
                'last_name' => 'Silva',
                'email' => 'nimal.silva@example.com',
                'phone' => '+94 71 876 5432',
                'address' => '78 Kandy Road',
                'city' => 'Kandy',
                'postal_code' => '20000',
                'status' => 'delivered',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'days_ago' => 3,
                'items' => [
                    ['slug' => 'apple-airpods-pro-2nd-generation-usb-c', 'qty' => 1],
                    ['slug' => 'anker-soundcore-liberty-4-nc-earbuds', 'qty' => 2],
                ],
            ],
            [
                'order_number' => 'ST-2026-9022',
                'first_name' => 'Dilshan',
                'last_name' => 'Fernando',
                'email' => 'dilshan.f@example.com',
                'phone' => '+94 76 345 6789',
                'address' => '142 Beach Road',
                'city' => 'Negombo',
                'postal_code' => '11500',
                'status' => 'shipped',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'days_ago' => 5,
                'items' => [
                    ['slug' => 'jbl-charge-5-portable-waterproof-speaker', 'qty' => 1],
                ],
            ],
            [
                'order_number' => 'ST-2026-9021',
                'first_name' => 'Sample',
                'last_name' => 'Customer',
                'email' => 'customer@simplytek.com',
                'phone' => '+94 77 987 6543',
                'address' => '12 Havelock Road',
                'city' => 'Colombo 05',
                'postal_code' => '00500',
                'status' => 'delivered',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'days_ago' => 8,
                'items' => [
                    ['slug' => 'anker-737-power-bank-powercore-24k', 'qty' => 1],
                ],
            ],
            [
                'order_number' => 'ST-2026-9020',
                'first_name' => 'Praveen',
                'last_name' => 'Jayawardena',
                'email' => 'praveen.j@example.com',
                'phone' => '+94 72 456 7890',
                'address' => '89 Main Street',
                'city' => 'Galle',
                'postal_code' => '80000',
                'status' => 'cancelled',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'days_ago' => 12,
                'items' => [
                    ['slug' => 'xiaomi-smart-camera-c400-2-5k', 'qty' => 2],
                ],
            ],
            [
                'order_number' => 'ST-2026-9019',
                'first_name' => 'Chamari',
                'last_name' => 'Wickramasinghe',
                'email' => 'chamari.w@example.com',
                'phone' => '+94 77 654 3210',
                'address' => '33 Temple Road',
                'city' => 'Kurunegala',
                'postal_code' => '60000',
                'status' => 'delivered',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'days_ago' => 15,
                'items' => [
                    ['slug' => 'apple-watch-ultra-2-gps-cellular-49mm', 'qty' => 1],
                ],
            ],
        ];

        foreach ($sampleOrders as $orderData) {
            $orderDate = Carbon::now()->subDays($orderData['days_ago']);

            $userId = ($orderData['email'] === 'customer@simplytek.com' && $customer)
                ? $customer->id
                : null;

            $subtotal = 0;
            $itemsToCreate = [];

            foreach ($orderData['items'] as $itemInfo) {
                $product = $products->firstWhere('slug', $itemInfo['slug']) ?? $products->first();
                if ($product) {
                    $itemSubtotal = $product->selling_price * $itemInfo['qty'];
                    $subtotal += $itemSubtotal;

                    $itemsToCreate[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->selling_price,
                        'quantity' => $itemInfo['qty'],
                        'subtotal' => $itemSubtotal,
                        'warranty' => $product->warranty,
                        'product_image' => $product->images->first()?->image_path,
                    ];
                }
            }

            $shipping = $subtotal > 20000 ? 0.00 : 450.00;
            $total = $subtotal + $shipping;

            $order = Order::updateOrCreate(
                ['order_number' => $orderData['order_number']],
                [
                    'user_id' => $userId,
                    'status' => $orderData['status'],
                    'subtotal' => $subtotal,
                    'discount_amount' => 0.00,
                    'shipping_amount' => $shipping,
                    'total_amount' => $total,
                    'payment_method' => $orderData['payment_method'],
                    'payment_status' => $orderData['payment_status'],
                    'first_name' => $orderData['first_name'],
                    'last_name' => $orderData['last_name'],
                    'email' => $orderData['email'],
                    'phone' => $orderData['phone'],
                    'address' => $orderData['address'],
                    'city' => $orderData['city'],
                    'postal_code' => $orderData['postal_code'],
                    'country' => 'Sri Lanka',
                    'notes' => 'Handle with care.',
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]
            );

            // Clean existing items before recreation
            $order->items()->delete();

            foreach ($itemsToCreate as $itemData) {
                $order->items()->create($itemData);
            }
        }
    }
}
