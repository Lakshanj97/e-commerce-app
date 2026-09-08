<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class TermsPage extends Component
{
    public function render()
    {
        return view('livewire.customer.terms-page')
            ->layout('layouts.customer.app');
    }
}
