<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StripeService
{
    /**
     * Create a Stripe Checkout Session for the given order.
     *
     * @return array{id: string, url: string}
     *
     * @throws Exception
     */
    public function createCheckoutSession(Order $order, string $successUrl, string $cancelUrl): array
    {
        $secretKey = config('services.stripe.secret') ?? env('STRIPE_SECRET');

        if (empty($secretKey)) {
            // Simulated Stripe session for development/testing when API key is not configured
            Log::info("Simulating Stripe Checkout session for Order #{$order->order_number}");

            return [
                'id' => 'sim_cs_'.bin2hex(random_bytes(12)),
                'url' => $successUrl.'?session_id=sim_'.bin2hex(random_bytes(10)),
            ];
        }

        $lineItems = [];

        foreach ($order->items as $index => $item) {
            $lineItems["line_items[{$index}][price_data][currency]"] = 'lkr';
            // Stripe expects amount in smallest currency unit (cents/cents equivalent)
            $lineItems["line_items[{$index}][price_data][unit_amount]"] = (int) round($item->price * 100);
            $lineItems["line_items[{$index}][price_data][product_data][name]"] = $item->product_name;
            if (! empty($item->product_image)) {
                $lineItems["line_items[{$index}][price_data][product_data][images][0]"] = $item->product_image;
            }
            $lineItems["line_items[{$index}][quantity]"] = $item->quantity;
        }

        // Add Shipping line item if applicable
        if ($order->shipping_amount > 0) {
            $shipIndex = count($order->items);
            $lineItems["line_items[{$shipIndex}][price_data][currency]"] = 'lkr';
            $lineItems["line_items[{$shipIndex}][price_data][unit_amount]"] = (int) round($order->shipping_amount * 100);
            $lineItems["line_items[{$shipIndex}][price_data][product_data][name]"] = 'Delivery / Shipping Fee';
            $lineItems["line_items[{$shipIndex}][quantity]"] = 1;
        }

        $payload = array_merge([
            'payment_method_types[0]' => 'card',
            'mode' => 'payment',
            'customer_email' => $order->email,
            'client_reference_id' => (string) $order->id,
            'metadata[order_id]' => (string) $order->id,
            'metadata[order_number]' => $order->order_number,
            'success_url' => $successUrl.'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $cancelUrl,
        ], $lineItems);

        $response = Http::withToken($secretKey)
            ->asForm()
            ->post('https://api.stripe.com/v1/checkout/sessions', $payload);

        if ($response->failed()) {
            Log::error('Stripe Checkout Session Creation Failed', [
                'order_id' => $order->id,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            $errorMsg = $response->json('error.message') ?? 'Failed to initialize Stripe checkout.';
            throw new Exception($errorMsg);
        }

        $sessionData = $response->json();

        return [
            'id' => $sessionData['id'],
            'url' => $sessionData['url'],
        ];
    }
}
