<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AddCategory extends Component
{
    public ?Category $category = null;

    public ?int $categoryId = null;

    public string $name = '';

    public ?int $parent_id = null;

    public bool $status = true;

    public function mount(?Category $category = null)
    {
        if ($category && $category->exists) {

            $this->category = $category;
            $this->categoryId = $category->id;

            $this->name = $category->name;
            $this->parent_id = $category->parent_id;
            $this->status = $category->status;
        }
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status' => ['boolean'],
        ];
    }

    public function save()
    {
        $this->validate();

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'parent_id' => $this->parent_id,
                'status' => $this->status,
            ]
        );

        session()->flash(
            'success',
            $this->categoryId
                ? 'Category updated successfully.'
                : 'Category created successfully.'
        );

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view(
            'livewire.admin.categories.add-category',
            [
                'parentCategories' => Category::query()
                    ->whereNull('parent_id')
                    ->when(
                        $this->categoryId,
                        fn($query) => $query->where('id', '!=', $this->categoryId)
                    )
                    ->orderBy('name')
                    ->get()
            ]
        )->layout('layouts.admin.app');
    }
}
