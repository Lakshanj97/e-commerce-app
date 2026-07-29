<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCategory extends Component
{
    use WithFileUploads;

    public ?Category $category = null;

    public ?int $categoryId = null;

    public string $name = '';

    public string $slug = '';

    public ?int $parent_id = null;

    public bool $status = true;

    // Holds the uploaded file object (Livewire TemporaryUploadedFile)
    public $newImage = null;

    // Holds the existing stored image path (string from DB)
    public ?string $existingImage = null;

    public bool $removeImage = false;

    public function mount(?Category $category = null)
    {
        if ($category && $category->exists) {
            $this->category      = $category;
            $this->categoryId    = $category->id;
            $this->name          = $category->name;
            $this->slug          = $category->slug ?? Str::slug($category->name);
            $this->parent_id     = $category->parent_id;
            $this->status        = $category->status;
            $this->existingImage = $category->image;
        }
    }

    // Auto-generate slug when name changes, but only if slug hasn't been
    // manually edited (i.e. slug still matches the auto-generated version).
    public function updatedName(string $value): void
    {
        $autoSlug = Str::slug($value);

        // Only overwrite if slug is empty OR still matches the previous auto value
        if (empty($this->slug) || $this->slug === Str::slug($this->name)) {
            $this->slug = $autoSlug;
        }
    }

    // Sanitise the slug if the user types it manually
    public function updatedSlug(string $value): void
    {
        $this->slug = Str::slug($value);
    }

    protected function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'slug'     => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status'   => ['boolean'],
            'newImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'newImage.image'  => 'The file must be an image.',
            'newImage.mimes'  => 'Only JPG, PNG, or WebP images are allowed.',
            'newImage.max'    => 'Image must not exceed 2 MB.',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            // Resolve final image path
            $imagePath = $this->existingImage; // default: keep existing

            if ($this->removeImage) {
                // User clicked "Remove" — delete old file if it exists
                if ($this->existingImage && \Storage::disk('public')->exists($this->existingImage)) {
                    \Storage::disk('public')->delete($this->existingImage);
                }
                $imagePath = null;
            }

            if ($this->newImage) {
                // Delete old image before storing new one
                if ($this->existingImage && \Storage::disk('public')->exists($this->existingImage)) {
                    \Storage::disk('public')->delete($this->existingImage);
                }
                $imagePath = $this->newImage->store('categories', 'public');
            }

            \DB::transaction(function () use ($imagePath) {
                Category::updateOrCreate(
                    ['id' => $this->categoryId],
                    [
                        'name'      => $this->name,
                        'slug'      => $this->slug,
                        'parent_id' => $this->parent_id,
                        'status'    => $this->status,
                        'image'     => $imagePath,
                    ]
                );
            });

            session()->flash(
                'success',
                $this->categoryId ? 'Category updated successfully.' : 'Category created successfully.'
            );

            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            \Log::error('Category save failed: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong! Please try again.');
        }
    }

    public function removeExistingImage(): void
    {
        $this->removeImage    = true;
        $this->existingImage  = null;
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
                        fn($q) => $q->where('id', '!=', $this->categoryId)
                    )
                    ->orderBy('name')
                    ->get(),
            ]
        )->layout('layouts.admin.app');
    }
}
