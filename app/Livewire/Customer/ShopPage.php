<?php

namespace App\Livewire\Customer;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $categoryId = null;

    /** @var array<int> */
    public array $brandIds = [];

    public string $sort = 'newest';

    public int $minPrice = 0;

    public int $maxPrice = 1000000;

    public int $priceMax = 1000000;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'brandIds' => ['except' => []],
        'sort' => ['except' => 'newest'],
    ];

    public function mount(): void
    {
        $max = rescue(fn () => (int) Product::where('is_active', true)->max('selling_price'), 1000000);
        $this->priceMax = $max ?: 1000000;
        $this->maxPrice = $this->priceMax;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatingBrandIds(): void
    {
        $this->resetPage();
    }

    public function updatingSort(): void
    {
        $this->resetPage();
    }

    public function setCategory(?int $id): void
    {
        $this->categoryId = $this->categoryId === $id ? null : $id;
        $this->resetPage();
    }

    public function toggleBrand(int $id): void
    {
        if (in_array($id, $this->brandIds)) {
            $this->brandIds = array_values(array_filter($this->brandIds, fn ($b) => $b !== $id));
        } else {
            $this->brandIds[] = $id;
        }
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->categoryId = null;
        $this->brandIds = [];
        $this->sort = 'newest';
        $this->maxPrice = $this->priceMax;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with(['images', 'brand', 'category'])
            ->where('is_active', true);

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('short_description', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        if (! empty($this->brandIds)) {
            $query->whereIn('brand_id', $this->brandIds);
        }

        $query->where('selling_price', '<=', $this->maxPrice);

        match ($this->sort) {
            'price_asc' => $query->orderBy('selling_price'),
            'price_desc' => $query->orderByDesc('selling_price'),
            'featured' => $query->orderByDesc('is_featured'),
            default => $query->latest(),
        };

        $products = rescue(fn () => $query->paginate(12), collect());

        $categories = rescue(fn () => Category::whereNull('parent_id')->where('is_active', true)->get(), collect());
        $brands = rescue(fn () => Brand::where('is_active', true)->get(), collect());

        return view('livewire.customer.shop-page', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ])->layout('layouts.customer.app');
    }
}
