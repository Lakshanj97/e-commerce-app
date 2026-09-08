<?php

namespace App\Livewire\Customer;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        $canConnect = rescue(fn () => DB::connection()->getPdo(), false, false);
        $brands = $canConnect ? rescue(fn () => Brand::where('is_active', true)->get(), collect(), false) : collect();

        return view('livewire.customer.about-us', [
            'brands' => $brands,
        ])->layout('layouts.customer.app');
    }
}
