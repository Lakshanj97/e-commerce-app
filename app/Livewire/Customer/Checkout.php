<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Checkout extends Component
{
    // Customer Contact & Shipping Information
    #[Validate('required|string|min:2|max:50', as: 'first name')]
    public string $firstName = '';

    #[Validate('required|string|min:2|max:50', as: 'last name')]
    public string $lastName = '';

    #[Validate('required|email|max:100', as: 'email address')]
    public string $email = '';

    #[Validate('required|string|min:9|max:20', as: 'phone number')]
    public string $phone = '';

    #[Validate('required|string|min:5|max:255', as: 'street address')]
    public string $address = '';

    #[Validate('required|string|min:2|max:100', as: 'city')]
    public string $city = '';

    #[Validate('nullable|string|max:100', as: 'state / province')]
    public string $state = '';

    #[Validate('nullable|string|max:20', as: 'postal code')]
    public string $postalCode = '';

    #[Validate('required|string|max:100', as: 'country')]
    public string $country = 'Sri Lanka';

    #[Validate('nullable|string|max:500', as: 'order notes')]
    public string $notes = '';

    // Payment Selection ('stripe' or 'cod')
    #[Validate('required|in:stripe,cod', as: 'payment method')]
    public string $paymentMethod = 'stripe';

    // Cart and order calculation attributes
    public array $cart = [];

    public float $shippingFee = 350.00;

    public float $freeShippingThreshold = 5000.00;

    public float $discountAmount = 0.00;

    public ?string $appliedCoupon = null;

    /**
     * Mount checkout component and pre-fill details if authenticated.
     */
    public function mount(): void
    {
        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            $this->redirectRoute('cart');

            return;
        }

        // Prefill user data if logged in
        if (auth()->check()) {
            $user = auth()->user();
            $nameParts = explode(' ', $user->name, 2);
            $this->firstName = $nameParts[0] ?? '';
            $this->lastName = $nameParts[1] ?? '';
            $this->email = $user->email ?? '';
        }
    }

    /**
     * Validate form and place the order with Stripe checkout redirection.
     */
    public function processCheckout(StripeService $stripeService)
    {
        $this->validate();

        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');
            $this->redirectRoute('cart');

            return;
        }

        try {
            $order = DB::transaction(function () {
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => Order::generateOrderNumber(),
                    'status' => 'pending',
                    'subtotal' => $this->subtotal,
                    'discount_amount' => $this->discountAmount,
                    'shipping_amount' => $this->shipping,
                    'total_amount' => $this->total,
                    'payment_method' => $this->paymentMethod,
                    'payment_status' => 'pending',
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'city' => $this->city,
                    'state' => $this->state,
                    'postal_code' => $this->postalCode,
                    'country' => $this->country,
                    'notes' => $this->notes,
                ]);

                foreach ($this->cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'] ?? null,
                        'product_name' => $item['name'] ?? 'Product',
                        'price' => (float) ($item['price'] ?? 0),
                        'quantity' => (int) ($item['quantity'] ?? 1),
                        'subtotal' => (float) (($item['price'] ?? 0) * ($item['quantity'] ?? 1)),
                        'warranty' => $item['warranty'] ?? null,
                        'product_image' => $item['image'] ?? null,
                    ]);
                }

                return $order;
            });

            // Handle Stripe Payment
            if ($this->paymentMethod === 'stripe') {
                $successUrl = route('checkout.success', ['order' => $order->id]);
                $cancelUrl = route('checkout.cancel', ['order' => $order->id]);

                $session = $stripeService->createCheckoutSession($order, $successUrl, $cancelUrl);

                $order->update([
                    'stripe_session_id' => $session['id'],
                ]);

                // Redirect to Stripe Checkout page
                return $this->redirect($session['url'], navigate: false);
            }

            // Handle Cash on Delivery (COD)
            if ($this->paymentMethod === 'cod') {
                $order->update([
                    'status' => 'processing',
                ]);

                session()->forget('cart');

                return $this->redirectRoute('checkout.success', ['order' => $order->id]);
            }
        } catch (Exception $e) {
            session()->flash('error', 'Checkout error: '.$e->getMessage());
        }
    }

    /**
     * Compute items subtotal.
     */
    #[Computed]
    public function subtotal(): float
    {
        $subtotal = 0.0;

        foreach ($this->cart as $item) {
            $subtotal += ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        }

        return round($subtotal, 2);
    }

    /**
     * Compute shipping amount based on threshold.
     */
    #[Computed]
    public function shipping(): float
    {
        if (empty($this->cart) || $this->subtotal >= $this->freeShippingThreshold) {
            return 0.00;
        }

        return $this->shippingFee;
    }

    /**
     * Compute grand total.
     */
    #[Computed]
    public function total(): float
    {
        return max(0.0, round($this->subtotal - $this->discountAmount + $this->shipping, 2));
    }

    /**
     * Total item quantity.
     */
    #[Computed]
    public function totalCount(): int
    {
        $count = 0;

        foreach ($this->cart as $item) {
            $count += (int) ($item['quantity'] ?? 0);
        }

        return $count;
    }

    public function render()
    {
        return view('livewire.customer.checkout')
            ->layout('layouts.customer.app');
    }
}
