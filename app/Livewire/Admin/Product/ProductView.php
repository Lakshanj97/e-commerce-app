<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class ProductView extends Component
{
    public $product;
    public $deleteId = null;
    public $deleteName = '';

    public function mount(Product $product) {
        $this->product = $product;
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

    public function render()
    {
        return view('livewire.admin.product.product-view'
                )->layout('layouts.admin.app');
    }
}
