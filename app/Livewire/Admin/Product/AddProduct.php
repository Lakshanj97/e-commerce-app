<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public ?Product $product = null;

    public ?int $productId = null;

    public string $name = '';

    public string $slug = '';

    public int $category_id = 0;

    public $categories = [];

    public int $brand_id = 0;

    public $brandList = [];

    public float $original_price = 0;

    public float $selling_price = 0;

    public int $quantity = 0;

    public string $warranty = '';

    public int $is_active = 1;

    public int $is_featured = 0;

    public string $short_description = '';

    public string $description = '';

    public $image_list = [];

    public $existingImages = [];

    public function mount(?Product $product = null, $id = null)
    {
        if ($product && $product->exists) {
            $this->product = $product;
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->slug = $product->slug;
            $this->category_id = $product->category_id;
            $this->original_price = $product->original_price;
            $this->selling_price = $product->selling_price;
            $this->quantity = $product->quantity;
            $this->warranty = $product->warranty;
            $this->is_active = (int) $product->is_active;
            $this->is_featured = (int) $product->is_featured;
            $this->short_description = $product->short_description;
            $this->description = $product->description;
            $this->existingImages = $this->product->images()->get()->toArray();
        }

        // Load real categories from DB
        $this->categories = Category::all();

        // Load brand list from DB
        $this->brandList = Brand::all();

        if ($id) {
            $product = Product::findOrFail($id);
            $this->category_id = $product->category_id;
            $this->brand_id = $product->brand_id;
        }
    }

    // Auto-generate slug when name is typed
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function removeImage($index)
    {
        unset($this->image_list[$index]);
        $this->image_list = array_values($this->image_list);
    }

    public function deleteExistingImage($imageId)
    {
        $image = ProductImage::find($imageId);

        if ($image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
            $this->existingImages = array_values(
                array_filter($this->existingImages, fn ($img) => $img['id'] !== $imageId)
            );
        }
    }

    // Validation rules
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,'.$this->productId,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'warranty' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'image_list.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $product = Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'original_price' => $this->original_price,
                'selling_price' => $this->selling_price,
                'quantity' => $this->quantity,
                'warranty' => $this->warranty,
                'is_active' => $this->is_active,
                'is_featured' => $this->is_featured,
            ]
        );

        if ($this->image_list) {
            $hasPrimary = $product->images()->where('is_primary', true)->exists();

            foreach ($this->image_list as $index => $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => ! $hasPrimary && $index === 0,
                ]);

                if (! $hasPrimary && $index === 0) {
                    $hasPrimary = true;
                }
            }
        }

        session()->flash(
            'success',
            $this->productId
                ? 'Product updated successfully.'
                : 'Product created successfully.'
        );

        $this->reset();

        return redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.product.add-product')
            ->layout('layouts.admin.app');
    }
}
