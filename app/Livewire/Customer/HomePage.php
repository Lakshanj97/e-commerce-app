<?php

namespace App\Livewire\Customer;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public string $activeBrandSlug = 'anker';

    public string $newsletterEmail = '';

    public function setActiveBrand(string $slug): void
    {
        $this->activeBrandSlug = $slug;
    }

    public function addToCart(int|string $productId, int $quantity = 1): void
    {
        $product = rescue(fn () => Product::find($productId), null);

        if (! $product) {
            session()->flash('error', 'Product not found.');

            return;
        }

        if ($product->quantity <= 0) {
            session()->flash('error', 'Sorry, this product is currently out of stock.');

            return;
        }

        $this->dispatch('add-to-cart', productId: (int) $productId, quantity: $quantity);
        session()->flash('cart_success', "{$product->name} added to cart!");
    }

    public function subscribeNewsletter(): void
    {
        $this->validate([
            'newsletterEmail' => 'required|email',
        ], [
            'newsletterEmail.required' => 'Please enter your email address.',
            'newsletterEmail.email' => 'Please enter a valid email address.',
        ]);

        $this->newsletterEmail = '';
        session()->flash('newsletter_success', "🎉 You're on the list! Check your inbox for your 10% welcome coupon.");
    }

    public function render()
    {
        // 1. Top categories with children and product count
        $categories = rescue(
            fn () => Category::whereNull('parent_id')
                ->where('status', true)
                ->withCount('products')
                ->get(),
            collect()
        );

        // 2. Active Brands for dynamic tabs
        $brands = rescue(
            fn () => Brand::where('is_active', true)->get(),
            collect()
        );

        // 3. Featured Products for Active Brand or All
        $featuredQuery = Product::with(['images', 'brand', 'category'])
            ->where('is_active', true);

        if ($this->activeBrandSlug && $this->activeBrandSlug !== 'all') {
            $featuredQuery->whereHas('brand', function ($q) {
                $q->where('slug', $this->activeBrandSlug);
            });
        } else {
            $featuredQuery->where('is_featured', true);
        }

        $featuredProducts = rescue(fn () => $featuredQuery->latest()->take(12)->get(), collect());

        // Fallback: if brand has no products, return general featured products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = rescue(
                fn () => Product::with(['images', 'brand', 'category'])
                    ->where('is_active', true)
                    ->latest()
                    ->take(8)
                    ->get(),
                collect()
            );
        }

        // 4. Flash Deals (Products with price discounts)
        $flashDeals = rescue(
            fn () => Product::with(['images', 'brand', 'category'])
                ->where('is_active', true)
                ->whereColumn('original_price', '>', 'selling_price')
                ->latest()
                ->take(6)
                ->get(),
            collect()
        );

        // 5. New Arrivals (Latest active products)
        $newArrivals = rescue(
            fn () => Product::with(['images', 'brand', 'category'])
                ->where('is_active', true)
                ->latest()
                ->take(8)
                ->get(),
            collect()
        );

        return view('livewire.customer.home-page', [
            'categories' => $categories,
            'brands' => $brands,
            'featuredProducts' => $featuredProducts,
            'flashDeals' => $flashDeals,
            'newArrivals' => $newArrivals,
        ])->layout('layouts.customer.app');
    }
}
