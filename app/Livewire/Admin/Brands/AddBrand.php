<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddBrand extends Component
{
    use WithFileUploads;

    public ?Brand $brand = null;

    public ?int $brandId = null;

    public string $name = '';

    public $logo = null;

    public ?string $existingLogo = null;

    public int $is_active = 1;

    public function mount(?Brand $brand = null)
    {
        if ($brand && $brand->exists) {
            $this->brand = $brand;
            $this->brandId = $brand->id;
            $this->name = $brand->name;
            $this->existingLogo = $brand->logo_path;
            $this->is_active = $brand->is_active;
        }
    }

    public function removeLogo()
    {
        $this->logo = null;
    }

    public function removeExistingLogo()
    {
        Storage::disk('public')->delete($this->existingLogo);
        $this->existingLogo = null;
        if ($this->brand) {
            $this->brand->update(['logo_path' => null]); // missing
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
            'is_active' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        $brand = Brand::updateOrCreate(
            ['id' => $this->brandId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'is_active' => $this->is_active,
            ]
        );

        if ($this->logo) {
            if ($this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo); // handles #6
            }
            $logoPath = $this->logo->store('brands', 'public');
            $brand->update(['logo_path' => $logoPath]);
        } elseif (! $this->existingLogo) {
            $brand->update(['logo_path' => null]); // handles #4, assuming #3 is fixed too
        }

        session()->flash(
            'success',
            $this->brandId
                ? 'Brand updated successfully.'
                : 'Brand created successfully.'
        );

        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.admin.brands.add-brand')
            ->layout('layouts.admin.app');
    }
}
