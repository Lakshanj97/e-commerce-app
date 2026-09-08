<?php

namespace App\Livewire\Customer;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    public string $slug;

    public ?int $subcategoryId = null;

    public string $search = '';

    /** @var array<int> */
    public array $brandIds = [];

    public string $sort = 'newest';

    public int $minPrice = 0;

    public int $maxPrice = 1000000;

    public int $priceMax = 1000000;

    protected $queryString = [
        'search' => ['except' => ''],
        'subcategoryId' => ['except' => null],
        'brandIds' => ['except' => []],
        'sort' => ['except' => 'newest'],
    ];

    public function mount(string $slug): void
    {
        $this->slug = $slug;

        $category = Category::where('slug', $this->slug)->first();

        if (! $category) {
            abort(404, 'Category not found');
        }

        $allCategoryIds = Category::where('parent_id', $category->id)
            ->pluck('id')
            ->push($category->id)
            ->all();

        $max = rescue(
            fn () => (int) Product::whereIn('category_id', $allCategoryIds)->where('is_active', true)->max('selling_price'),
            1000000
        );

        $this->priceMax = $max > 0 ? $max : 1000000;
        $this->maxPrice = $this->priceMax;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSubcategoryId(): void
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

    public function filterSubcategory(?int $id): void
    {
        $this->subcategoryId = $this->subcategoryId === $id ? null : $id;
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
        $this->subcategoryId = null;
        $this->brandIds = [];
        $this->sort = 'newest';
        $this->maxPrice = $this->priceMax;
        $this->resetPage();
    }

    public function render()
    {
        $category = Category::with('children')->where('slug', $this->slug)->firstOrFail();

        $targetCategoryIds = $this->subcategoryId
            ? [$this->subcategoryId]
            : $category->children->pluck('id')->push($category->id)->all();

        $query = Product::with(['images', 'brand', 'category'])
            ->whereIn('category_id', $targetCategoryIds)
            ->where('is_active', true);

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('short_description', 'like', '%'.$this->search.'%');
            });
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

        $brands = rescue(
            fn () => Brand::whereHas('products', fn ($q) => $q->whereIn('category_id', $targetCategoryIds))->get(),
            collect()
        );

        return view('livewire.customer.category-products', [
            'category' => $category,
            'products' => $products,
            'brands' => $brands,
            'subcategories' => $category->children,
        ])->layout('layouts.customer.app');
    }
}
