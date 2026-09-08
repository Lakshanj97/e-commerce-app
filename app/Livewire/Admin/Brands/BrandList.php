<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandList extends Component
{
    use WithPagination;

    public $search = '';

    public $deleteId = null;

    public $deleteName = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $brand = Brand::findOrFail($id);

        $this->deleteId = $brand->id;
        $this->deleteName = $brand->name;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function deleteBrand()
    {
        Brand::findOrFail($this->deleteId)->delete();

        $this->cancelDelete();

        session()->flash(
            'success',
            'Brand deleted successfully.'
        );
    }

    public function searchBrands()
    {
        return Brand::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('is_active', 'like', '%'.$this->search.'%');
            });
    }

    public function render()
    {
        $brands = $this->searchBrands()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view(
            'livewire.admin.brands.brand-list',
            compact('brands')
        )->layout('layouts.admin.app');
    }
}
