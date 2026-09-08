<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class FaqPage extends Component
{
    public string $activeCategory = 'all';

    public string $search = '';

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function render()
    {
        $allFaqs = [
            [
                'category' => 'delivery',
                'category_name' => 'Shipping & Delivery',
                'q' => 'How long does delivery take across Sri Lanka?',
                'a' => 'For deliveries within the Colombo Municipal Council limits, we typically dispatch and deliver within 24 hours. Greater Colombo and Western Province destinations take 24–48 hours, while all other outstation locations island-wide arrive within 2 to 3 business days via our premium courier partners.',
            ],
            [
                'category' => 'delivery',
                'category_name' => 'Shipping & Delivery',
                'q' => 'Is island-wide delivery free?',
                'a' => 'Yes! We provide 100% Free Island-wide Delivery on all orders valued at Rs. 5,000 or above. For orders below this threshold, a flat delivery fee of Rs. 350 is applied at checkout.',
            ],
            [
                'category' => 'delivery',
                'category_name' => 'Shipping & Delivery',
                'q' => 'How can I track the live status of my shipment?',
                'a' => 'Once your order is processed, you will receive a tracking confirmation via SMS and email with an order reference code (ORD-...). You can enter this code into our real-time Order Tracking page to track every step of your shipment.',
            ],
            [
                'category' => 'payments',
                'category_name' => 'Payments & Installments',
                'q' => 'How do the 3-installment interest-free plans work?',
                'a' => 'We have integrated with KOKO and MintPay. When you check out, select either KOKO or MintPay as your payment method. Your total purchase will be split into 3 equal installments with 0% interest and 0 hidden fees. Your order is dispatched immediately upon the first 1/3rd payment.',
            ],
            [
                'category' => 'payments',
                'category_name' => 'Payments & Installments',
                'q' => 'What payment methods do you accept?',
                'a' => 'We accept all major Visa and MasterCard credit/debit cards (secured via Stripe), KOKO, MintPay, direct bank transfer / deposit, and Cash on Delivery (COD) for eligible orders.',
            ],
            [
                'category' => 'warranty',
                'category_name' => 'Warranty & Authenticity',
                'q' => 'Are all products 100% genuine and original?',
                'a' => 'Absolutely. SimplyTek has a strict zero-tolerance policy against counterfeit or replica goods. All devices (Apple, Samsung, Anker, Sony, JBL, etc.) are brand new, sealed in original manufacturer packaging with verifiable serial numbers.',
            ],
            [
                'category' => 'warranty',
                'category_name' => 'Warranty & Authenticity',
                'q' => 'How do I claim warranty if my device has a hardware issue?',
                'a' => 'Simply contact our support team via WhatsApp or email with your order receipt and a photo/video of the issue. For brands like Anker, we offer a hassle-free one-to-one replacement warranty within the warranty period.',
            ],
            [
                'category' => 'returns',
                'category_name' => 'Returns & Refunds',
                'q' => 'What is your return policy?',
                'a' => 'We offer a 7-Day Return and Replacement Policy for products that arrive defective, damaged in transit, or differ from what was ordered. Please report any issues within 7 days of delivery with original packaging and accessories intact.',
            ],
            [
                'category' => 'returns',
                'category_name' => 'Returns & Refunds',
                'q' => 'Can I cancel an order after placing it?',
                'a' => 'Orders can be cancelled before they have been handed over to our dispatch courier. Simply contact our support hotline (+94 11 234 5678) or WhatsApp immediately with your Order ID.',
            ],
        ];

        $faqs = collect($allFaqs)->filter(function ($faq) {
            $matchesCategory = $this->activeCategory === 'all' || $faq['category'] === $this->activeCategory;
            $matchesSearch = empty($this->search) ||
                str_contains(strtolower($faq['q']), strtolower($this->search)) ||
                str_contains(strtolower($faq['a']), strtolower($this->search));

            return $matchesCategory && $matchesSearch;
        })->values();

        return view('livewire.customer.faq-page', [
            'faqs' => $faqs,
        ])->layout('layouts.customer.app');
    }
}
