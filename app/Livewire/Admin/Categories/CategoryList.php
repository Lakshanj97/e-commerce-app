<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $deleteId = null;
    public string $deleteName = '';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $category = Category::findOrFail($id);

        $this->deleteId = $category->id;
        $this->deleteName = $category->name;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->deleteId)->delete();

        $this->cancelDelete();

        session()->flash(
            'success',
            'Category deleted successfully.'
        );
    }

    public function render()
    {
        $categories = Category::query()
            ->with('parent')
            ->when(
                $this->search,
                fn($query) =>
                $query->where('name', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->paginate(10);

        return view(
            'livewire.admin.categories.category-list',
            compact('categories')
        )->layout('layouts.admin.app');
    }
}
