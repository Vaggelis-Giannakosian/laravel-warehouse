<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProvidersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var  Provider
     */
    private Provider $provider;

    protected function setUp(): void
    {
        parent::setUp();
        $this->provider = Provider::factory()->create();
        $this->signIn(
            User::factory()->create(['country_id' => $this->provider->country_id])
        );
    }

    public function test_providers_crud_is_limited_to_auth_users()
    {
        auth()->logout();

        //Providers index
        $this->get(route('providers.index'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Provider create
        $this->get(route('providers.create'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Provider store
        $this->post(route('providers.store'), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Provider edit
        $this->get(route('providers.edit', $this->provider))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Provider update
        $this->put(route('providers.update', $this->provider), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Provider delete
        $this->delete(route('providers.destroy', $this->provider))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
    }

    public function test_providers_index()
    {
        $this->get(route('providers.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Providers/Index')
                ->has('providers', 1, fn(Assert $page) => $page
                    ->where('id', $this->provider->id)
                    ->etc()

                )
            );
    }

    public function test_providers_create_page()
    {
        $this->get(route('providers.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Providers/Create')
                ->has('countries')
            );
    }

    public function test_providers_store()
    {
        $newProvider = Provider::factory()->raw([
            'phone1'=>'2101234567',
            'phone2' => null,
            'fax' => null
        ]);

        $this->post(route('providers.store'), $newProvider)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('providers.index'));

        $this->assertDatabaseCount('providers', 2);
    }

    public function test_providers_edit()
    {
        $this->get(route('providers.edit', $this->provider))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Providers/Edit')
                ->has('countries')
                ->has('provider', fn(Assert $page) => $page
                    ->where('id', $this->provider->id)
                    ->where('name', $this->provider->name)
                    ->etc()
                )
            );
    }

    public function test_providers_update()
    {
        $newProvider = Provider::factory()->raw([
            'phone1'=>'2101234567',
            'phone2' => null,
            'fax' => null
        ]);

        $this->put(route('providers.update', $this->provider), $newProvider)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('providers.index'));

        $this->assertDatabaseCount('providers', 1);
        $this->assertDatabaseHas('providers', $newProvider);
    }

    public function test_providers_destroy()
    {
        $newProvider = Provider::factory()->create();

        $this->delete(route('providers.destroy', $newProvider))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('providers.index'));

        $this->assertDatabaseMissing('providers', $newProvider->toArray());
    }

    public function test_providers_with_associated_products_cannot_be_deleted()
    {
        $product = Product::factory()->create();

        $this->delete(route('providers.destroy', $product->provider))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('providers.index'))
            ->assertSessionHas('flash.message', 'Ο προμηθευτής δεν μπορεί να διαγραφτεί λόγω συσχετισμένων προϊόντων');

        $this->assertDatabaseCount('providers', 2);
        $this->assertDatabaseHas('providers', $product->provider->only('id'));
    }
}
