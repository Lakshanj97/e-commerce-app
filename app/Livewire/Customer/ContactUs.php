<?php

namespace App\Livewire\Customer;

use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContactUs extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = '';

    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|min:3|max:150',
            'message' => 'required|string|min:10|max:2000',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please write your message or inquiry.',
            'message.min' => 'Message must be at least 10 characters.',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        // In production, an email or notification can be sent here
        $this->reset(['name', 'email', 'phone', 'subject', 'message']);

        session()->flash('contact_success', 'Thank you! Your message has been received. Our team will get back to you within 24 hours.');
    }

    public function render()
    {
        $canConnect = rescue(fn () => DB::connection()->getPdo(), false, false);
        $profile = $canConnect ? rescue(fn () => CompanyProfile::first(), null, false) : null;

        return view('livewire.customer.contact-us', [
            'profile' => $profile,
        ])->layout('layouts.customer.app');
    }
}
