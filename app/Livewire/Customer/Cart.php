<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    /**
     * The cart items stored in memory and synced with session.
     * Structure: [
     *   productId => [
     *     'id' => int,
     *     'name' => string,
     *     'slug' => string,
     *     'price' => float,
     *     'original_price' => float,
     *     'quantity' => int,
     *     'max_quantity' => int,
     *     'image' => ?string,
     *     'warranty' => ?string,
     *   ]
     * ]
     *
     * @var array<int|string, array<string, mixed>>
     */
    public array $cart = [];

    /**
     * Flat shipping fee when order subtotal is below threshold.
     */
    public float $shippingFee = 350.00;

    /**
     * Free shipping threshold.
     */
    public float $freeShippingThreshold = 5000.00;

    /**
     * Promo coupon code entered by user.
     */
    public string $couponCode = '';

    /**
     * Currently applied coupon discount amount.
     */
    public float $discountAmount = 0.00;

    /**
     * Active applied coupon code name.
     */
    public ?string $appliedCoupon = null;

    /**
     * Mount the component and initialize cart from session.
     */
    public function mount(): void
    {
        $this->loadCart();
    }

    /**
     * Load and sanitize cart data from session.
     */
    protected function loadCart(): void
    {
        $sessionCart = session()->get('cart', []);

        $this->cart = is_array($sessionCart) ? $sessionCart : [];
    }

    /**
     * Persist current cart state to session and broadcast change event.
     */
    protected function saveCart(): void
    {
        session()->put('cart', $this->cart);
        $this->dispatch('cart-updated', count: $this->totalCount);
    }

    /**
     * Add a product to the cart with specified quantity.
     */
    public function add(int|string $productId, int $quantity = 1): void
    {
        $quantity = max(1, $quantity);

        $product = Product::with('images')->find($productId);

        if (! $product) {
            session()->flash('error', 'Product not found.');

            return;
        }

        if (! $product->is_active) {
            session()->flash('error', 'This product is currently unavailable.');

            return;
        }

        if ($product->quantity <= 0) {
            session()->flash('error', 'Sorry, this product is out of stock.');

            return;
        }

        $currentQty = isset($this->cart[$productId]) ? (int) $this->cart[$productId]['quantity'] : 0;
        $newQty = $currentQty + $quantity;

        if ($newQty > $product->quantity) {
            $newQty = $product->quantity;
            session()->flash('warning', "Only {$product->quantity} unit(s) available in stock. Added maximum available.");
        } else {
            session()->flash('success', "{$product->name} added to cart!");
        }

        // Determine best image URL
        $imageUrl = null;
        if (! empty($product->image_urls)) {
            $imageUrl = $product->image_urls[0];
        } elseif ($product->images && $product->images->isNotEmpty()) {
            $imageUrl = Storage::url($product->images->first()->image_path);
        }

        $this->cart[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => (float) $product->selling_price,
            'original_price' => (float) $product->original_price,
            'quantity' => $newQty,
            'max_quantity' => (int) $product->quantity,
            'image' => $imageUrl,
            'warranty' => $product->warranty,
        ];

        $this->saveCart();
    }

    /**
     * Event listener to allow adding to cart from anywhere in the application.
     */
    #[On('add-to-cart')]
    public function handleAddToCart(int|string $productId, int $quantity = 1): void
    {
        $this->add($productId, $quantity);
    }

    /**
     * Increment quantity of an item in the cart.
     */
    public function increment(int|string $productId): void
    {
        if (! isset($this->cart[$productId])) {
            return;
        }

        $maxStock = (int) ($this->cart[$productId]['max_quantity'] ?? 99);

        if ($this->cart[$productId]['quantity'] < $maxStock) {
            $this->cart[$productId]['quantity']++;
            $this->saveCart();
            session()->flash('success', 'Cart updated.');
        } else {
            session()->flash('warning', "Maximum available stock ({$maxStock}) reached for this item.");
        }
    }

    /**
     * Decrement quantity of an item in the cart.
     */
    public function decrement(int|string $productId): void
    {
        if (! isset($this->cart[$productId])) {
            return;
        }

        if ($this->cart[$productId]['quantity'] > 1) {
            $this->cart[$productId]['quantity']--;
            $this->saveCart();
            session()->flash('success', 'Cart updated.');
        } else {
            $this->remove($productId);
        }
    }

    /**
     * Explicitly update the quantity of an item.
     */
    public function updateQuantity(int|string $productId, int|string $quantity): void
    {
        if (! isset($this->cart[$productId])) {
            return;
        }

        $qty = (int) $quantity;

        if ($qty <= 0) {
            $this->remove($productId);

            return;
        }

        $maxStock = (int) ($this->cart[$productId]['max_quantity'] ?? 99);

        if ($qty > $maxStock) {
            $qty = $maxStock;
            session()->flash('warning', "Stock limited to {$maxStock} units.");
        }

        $this->cart[$productId]['quantity'] = $qty;
        $this->saveCart();
    }

    /**
     * Remove an item completely from the cart.
     */
    public function remove(int|string $productId): void
    {
        if (isset($this->cart[$productId])) {
            $name = $this->cart[$productId]['name'] ?? 'Item';
            unset($this->cart[$productId]);
            $this->saveCart();
            session()->flash('success', "{$name} removed from cart.");
        }
    }

    /**
     * Remove all items from the cart.
     */
    public function clear(): void
    {
        $this->cart = [];
        $this->discountAmount = 0.00;
        $this->appliedCoupon = null;
        $this->saveCart();
        session()->flash('success', 'Your cart has been cleared.');
    }

    /**
     * Apply a discount coupon code.
     */
    public function applyCoupon(): void
    {
        $code = strtoupper(trim($this->couponCode));

        if (empty($code)) {
            session()->flash('coupon_error', 'Please enter a coupon code.');

            return;
        }

        if ($code === 'SIMPLY10') {
            $this->discountAmount = round($this->subtotal * 0.10, 2);
            $this->appliedCoupon = 'SIMPLY10 (10% OFF)';
            session()->flash('coupon_success', 'Coupon applied successfully: 10% discount!');
        } elseif ($code === 'SAVE500') {
            $this->discountAmount = min(500.00, $this->subtotal);
            $this->appliedCoupon = 'SAVE500 (Rs. 500 OFF)';
            session()->flash('coupon_success', 'Coupon applied successfully: Rs. 500 discount!');
        } else {
            session()->flash('coupon_error', 'Invalid coupon code. Try SIMPLY10 or SAVE500.');
        }
    }

    /**
     * Remove applied coupon discount.
     */
    public function removeCoupon(): void
    {
        $this->couponCode = '';
        $this->discountAmount = 0.00;
        $this->appliedCoupon = null;
        session()->flash('success', 'Coupon removed.');
    }

    /**
     * Compute the subtotal of all items in the cart.
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
     * Compute original subtotal before discounts for comparison.
     */
    #[Computed]
    public function originalSubtotal(): float
    {
        $orig = 0.0;

        foreach ($this->cart as $item) {
            $origPrice = (float) ($item['original_price'] ?? $item['price'] ?? 0);
            $orig += $origPrice * ((int) ($item['quantity'] ?? 0));
        }

        return round($orig, 2);
    }

    /**
     * Compute total savings from product discounts.
     */
    #[Computed]
    public function productSavings(): float
    {
        return max(0.0, round($this->originalSubtotal - $this->subtotal, 2));
    }

    /**
     * Calculate shipping charge based on subtotal.
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
     * Compute grand total: subtotal - discount + shipping.
     */
    #[Computed]
    public function total(): float
    {
        return max(0.0, round($this->subtotal - $this->discountAmount + $this->shipping, 2));
    }

    /**
     * Compute total item count in the cart.
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

    /**
     * Check if cart is empty.
     */
    #[Computed]
    public function isEmpty(): bool
    {
        return empty($this->cart);
    }

    /**
     * Render the Livewire cart component view.
     */
    public function render()
    {
        return view('livewire.customer.cart')
            ->layout('layouts.customer.app');
    }
}
