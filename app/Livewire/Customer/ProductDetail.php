<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public int $quantity = 1;

    public string $activeTab = 'description';

    public string $activeImage = '';

    public function mount(string $slug): void
    {
        $this->product = rescue(
            fn () => Product::with(['images', 'brand', 'category'])->where('slug', $slug)->where('is_active', true)->firstOrFail(),
            fn () => abort(404)
        );

        $images = $this->product->image_urls;
        $this->activeImage = $images[0] ?? '';
    }

    public function setActiveImage(string $url): void
    {
        $this->activeImage = $url;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function incrementQuantity(): void
    {
        if ($this->quantity < $this->product->quantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart(): void
    {
        if ($this->product->quantity <= 0) {
            session()->flash('error', 'This product is out of stock.');

            return;
        }

        $this->dispatch('add-to-cart', productId: $this->product->id, quantity: $this->quantity);
        session()->flash('success', "Added {$this->quantity}× {$this->product->name} to your cart!");
    }

    public function render()
    {
        $relatedProducts = rescue(
            fn () => Product::with('images')
                ->where('is_active', true)
                ->where('id', '!=', $this->product->id)
                ->where(function ($q) {
                    $q->where('category_id', $this->product->category_id)
                        ->orWhere('brand_id', $this->product->brand_id);
                })
                ->inRandomOrder()
                ->take(8)
                ->get(),
            collect()
        );

        return view('livewire.customer.product-detail', [
            'relatedProducts' => $relatedProducts,
        ])->layout('layouts.customer.app');
    }
}
