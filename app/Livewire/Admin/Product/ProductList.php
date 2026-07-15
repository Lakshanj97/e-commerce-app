<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    // public $perPage = 10;

    public $deleteId = null;

    public $deleteName = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $product = Product::findOrFail($id);

        $this->deleteId = $product->id;
        $this->deleteName = $product->name;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function deleteProduct()
    {
        Product::findOrFail($this->deleteId)->delete();

        $this->cancelDelete();

        session()->flash(
            'success',
            'Product deleted successfully.'
        );
    }

    public function searchProducts()
    {
        return Product::query()
            ->with('category')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%'.$this->search.'%');
                    })
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('short_description', 'like', '%'.$this->search.'%')
                    ->orWhere('original_price', 'like', '%'.$this->search.'%')
                    ->orWhere('selling_price', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(20);
    }

    public function render()
    {
        $products = $this->searchProducts();

        return view('livewire.admin.product.product-list',
            compact('products')
        )->layout('layouts.admin.app');
    }
}
