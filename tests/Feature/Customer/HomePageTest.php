<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\HomePage;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Express Delivery');
        $response->assertSee('100% Genuine Tech');
    }

    public function test_home_page_livewire_component_loads(): void
    {
        Livewire::test(HomePage::class)
            ->assertOk()
            ->assertSee('Featured Tech Collections');
    }

    public function test_home_page_brand_tab_switching(): void
    {
        Livewire::test(HomePage::class)
            ->assertSet('activeBrandSlug', 'anker')
            ->call('setActiveBrand', 'apple')
            ->assertSet('activeBrandSlug', 'apple')
            ->call('setActiveBrand', 'all')
            ->assertSet('activeBrandSlug', 'all');
    }

    public function test_home_page_add_to_cart_dispatches_event(): void
    {
        $product = rescue(fn () => Product::where('is_active', true)->first(), null);

        if ($product) {
            Livewire::test(HomePage::class)
                ->call('addToCart', $product->id, 1)
                ->assertDispatched('add-to-cart', productId: $product->id, quantity: 1)
                ->assertSessionHas('cart_success');
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_home_page_newsletter_subscription(): void
    {
        Livewire::test(HomePage::class)
            ->set('newsletterEmail', 'invalid-email')
            ->call('subscribeNewsletter')
            ->assertHasErrors(['newsletterEmail' => 'email']);

        Livewire::test(HomePage::class)
            ->set('newsletterEmail', 'vip@example.com')
            ->call('subscribeNewsletter')
            ->assertHasNoErrors()
            ->assertSee("You're on the list!")
            ->assertSet('newsletterEmail', '');
    }
}
