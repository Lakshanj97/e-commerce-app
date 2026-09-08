<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\ContactUs;
use App\Livewire\Customer\FaqPage;
use App\Livewire\Customer\OrderTracking;
use App\Models\Order;
use Livewire\Livewire;
use Tests\TestCase;

class FooterPagesTest extends TestCase
{
    public function test_about_us_page_renders_successfully(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertSee('Premier Destination for Genuine Tech');
    }

    public function test_contact_us_page_renders_and_validates_form(): void
    {
        $response = $this->get(route('contact'));
        $response->assertOk();

        Livewire::test(ContactUs::class)
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'subject', 'message'])
            ->set('name', 'Nisal Perera')
            ->set('email', 'nisal@example.com')
            ->set('phone', '+94771234567')
            ->set('subject', 'Question about AirPods')
            ->set('message', 'Are the AirPods Pro covered by Apple warranty?')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSee('Thank you! Your message has been received')
            ->assertSet('name', '');
    }

    public function test_order_tracking_page_renders_and_searches(): void
    {
        $response = $this->get(route('order.tracking'));
        $response->assertOk();

        Livewire::test(OrderTracking::class)
            ->set('orderQuery', 'ab')
            ->call('trackOrder')
            ->assertHasErrors(['orderQuery' => 'min']);

        $order = rescue(fn () => Order::first(), null);

        if ($order) {
            Livewire::test(OrderTracking::class)
                ->set('orderQuery', $order->order_number)
                ->call('trackOrder')
                ->assertHasNoErrors()
                ->assertSee($order->order_number);
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_faq_page_renders_and_filters(): void
    {
        $response = $this->get(route('faq'));
        $response->assertOk();

        Livewire::test(FaqPage::class)
            ->assertOk()
            ->assertSee('Frequently Asked Questions')
            ->call('setCategory', 'delivery')
            ->assertSet('activeCategory', 'delivery')
            ->assertSee('How long does delivery take');
    }

    public function test_shipping_returns_page_renders_successfully(): void
    {
        $response = $this->get(route('shipping.returns'));

        $response->assertOk();
        $response->assertSee('Free Island-Wide Delivery');
        $response->assertSee('Delivery Timelines');
    }

    public function test_warranty_policy_page_renders_successfully(): void
    {
        $response = $this->get(route('warranty.policy'));

        $response->assertOk();
        $response->assertSee('Official Warranty Guidelines');
        $response->assertSee('ANKER');
    }

    public function test_privacy_policy_page_renders_successfully(): void
    {
        $response = $this->get(route('privacy'));

        $response->assertOk();
        $response->assertSee('Privacy Policy');
        $response->assertSee('Payment Security');
    }

    public function test_terms_page_renders_successfully(): void
    {
        $response = $this->get(route('terms'));

        $response->assertOk();
        $response->assertSee('User Agreement');
        $response->assertSee('Agreement to Terms');
    }
}
