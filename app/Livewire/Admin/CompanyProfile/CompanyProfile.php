<?php

namespace App\Livewire\Admin\CompanyProfile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CompanyProfile as CompanyProfileModel;
use Illuminate\Support\Facades\Storage;

class CompanyProfile extends Component
{
    use WithFileUploads;

    public string $company_name = '';
    public string $tax_number   = '';
    public string $address      = '';
    public string $phone        = '';
    public string $email        = '';
    public mixed $logo = null;

    // Crop feature
    public $logo_path = null;
    public $logoPreview = null;
    public bool $showCropModal = false;
    public bool $showRemoveLogoConfirm = false;

    protected $listeners = [
        'open-crop-modal' => 'openCropModal',
    ];

    //-------------------------------------------------------------------------
    // Crop Modal
    //-------------------------------------------------------------------------
    public function openCropModal(): void
    {
        $this->showCropModal = true;
    }

    // Re-crop existing logo
    public function openCropModalWithExisting(): void
    {
        $url = $this->logoPreview
            ?? ($this->logo_path ? asset($this->logo_path) : null);

        if (!$url) return;

        $this->showCropModal = true;
        $this->dispatch('crop-modal-opened', url: $url);
    }

    //-------------------------------------------------------------------------
    //Takes an existing record from the database, or returns an empty Model Instance.
    //-------------------------------------------------------------------------
    private function getCompanySettings(): CompanyProfileModel
    {
        return CompanyProfileModel::first() ?? new CompanyProfileModel();
    }

    //-------------------------------------------------------------------------
    //Update or Create new record
    //-------------------------------------------------------------------------
    private function updateCompanySettings(array $data): CompanyProfileModel
    {
        $settings = CompanyProfileModel::first();

        if ($settings) {
            $settings->update($data);
        } else {
            $settings = CompanyProfileModel::create($data);
        }

        return $settings;
    }

    //-------------------------------------------------------------------------
    // Validation Rules
    //-------------------------------------------------------------------------
    protected function rules(): array
    {
        return [
            'company_name' => 'nullable|string|max:255',
            'tax_number'   => 'nullable|string|max:255',
            'address'      => 'nullable|string|max:500',
            'phone'        => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    // -------------------------------------------------------------------------
    //Mount and Initialize
    // -------------------------------------------------------------------------
    public function mount(): void
    {
        $settings = $this->getCompanySettings();

        $this->company_name = $settings->company_name ?? '';
        $this->tax_number   = $settings->tax_number   ?? '';
        $this->address      = $settings->address      ?? '';
        $this->phone        = $settings->phone        ?? '';
        $this->email        = $settings->email        ?? '';
        $this->logo_path    = $settings->logo_path    ?? null;
    }

    // -------------------------------------------------------------------------
    // Update Logo and Show Crop Modal
    // -------------------------------------------------------------------------
    public function updatedLogo(): void
    {
        $this->validateOnly('logo');
        $tempUrl = $this->logo->temporaryUrl();
        $this->logoPreview = $tempUrl;
        $this->showCropModal = true;

        $this->dispatch('crop-modal-opened', url: $tempUrl);
    }

    // -------------------------------------------------------------------------
    // Save Cropped Image
    // -------------------------------------------------------------------------
    public function saveCroppedImage(string $base64Image): void
    {
        // Base64 header strip and decode
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $imageData = base64_decode($imageData);

        // Old cropped logo delete (when replacing previous crop)
        if ($this->logo_path && str_starts_with($this->logo_path, 'images/logo/cropped_')) {
            if (file_exists(public_path($this->logo_path))) {
                unlink(public_path($this->logo_path));
            }
        }

        // Save to public/images/logo/
        $dir = public_path('images/logo');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename    = 'cropped_' . uniqid() . '.png';
        $destination = $dir . '/' . $filename;
        file_put_contents($destination, $imageData);

        $this->logo_path   = 'images/logo/' . $filename;
        $this->logoPreview = asset($this->logo_path);
        $this->showCropModal = false;
    }

    // -------------------------------------------------------------------------
    // Remove Logo
    // -------------------------------------------------------------------------
    public function removeLogo(): void
    {
        if ($this->logo_path && file_exists(public_path($this->logo_path))) {
            unlink(public_path($this->logo_path));
        }

        $settings = $this->getCompanySettings();
        if ($settings->exists) {
            $settings->logo_path = null;
            $settings->save();
        }

        $this->logo_path             = null;
        $this->logo                  = null;
        $this->logoPreview           = null;
        $this->showRemoveLogoConfirm = false;
    }

    // -------------------------------------------------------------------------
    // Save Company Profile
    // -------------------------------------------------------------------------
    public function save(): void
    {
        $this->validate();

        $data = [
            'company_name' => $this->company_name,
            'tax_number'   => $this->tax_number,
            'address'      => $this->address,
            'phone'        => $this->phone,
            'email'        => $this->email,
        ];

        // Cropped image already saved — using logo_path
        if ($this->logo_path && str_starts_with($this->logo_path, 'images/logo/cropped_')) {
            $data['logo_path'] = $this->logo_path;
        } elseif ($this->logo) {
            // If you upload directly without cropping (fallback)
            $logoPath = $this->storeLogo();
            $data['logo_path'] = $logoPath;
        }

        $this->updateCompanySettings($data);
        $this->logo = null;
        session()->flash('success', 'Company profile updated successfully.');
    }

    // -------------------------------------------------------------------------
    // Store Logo
    // -------------------------------------------------------------------------
    private function storeLogo(): string
    {
        $dir         = public_path('images/logo');
        $destination = $dir . '/client-logo.png';

        if (! file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $this->logo->storeAs('', 'client-logo.png', 'public');

        $source = storage_path('app/public/client-logo.png');
        if (file_exists($source)) {
            copy($source, $destination);
            unlink($source);
        }

        return 'images/logo/client-logo.png';
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------
    public function render()
    {
        return view('livewire.admin.company-profile.company-profile')
            ->layout('layouts.admin.app');
    }
}
