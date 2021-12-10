<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var  Product
     */
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = Product::factory()->create();

        $this->signIn();
    }

    public function test_products_crud_is_limited_to_auth_users()
    {

        //Unauthenticated product
        auth()->logout();

        //Products index
        $this->get(route('products.index'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //Product create
        $this->get(route('products.create'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //Product store
        $this->post(route('products.store'), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //Product edit
        $this->get(route('products.edit', $this->product))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //Product update
        $this->put(route('products.update', $this->product), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //Product delete
        $this->delete(route('products.destroy', $this->product))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
    }

    public function test_products_index()
    {
        $this->get(route('products.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Products/Index')
                ->has('products', 1)
            );
    }

    public function test_products_create_page()
    {
        $this->get(route('products.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Products/Create')
                ->has('providers')
                ->has('categories')
            );
    }

    public function test_products_store()
    {
        $newProduct = Product::factory()->raw();

        $this->post(route('products.store'), $newProduct)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseCount('products', 2);
    }

    public function test_products_show()
    {
        $this->get(route('products.show', $this->product))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Products/Show')
                ->has('product', fn(Assert $page) => $page
                    ->where('id', $this->product->id)
                    ->etc()
                    ->has('prices')
                    ->has('category')
                    ->has('provider')
                )
            );
    }

    public function test_products_edit()
    {
        $this->get(route('products.edit', $this->product))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Products/Edit')
                ->has('providers')
                ->has('categories')
                ->has('product', fn(Assert $page) => $page
                    ->where('id', $this->product->id)
                    ->where('ska', $this->product->ska)
                    ->etc()
                )
            );
    }

    public function test_products_update()
    {
        $newProduct = Product::factory()->raw();

        $this->put(route('products.update', $this->product), $newProduct)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'name' => $newProduct['name'],
            'ska' => $newProduct['ska'],
            'quantity' => $newProduct['quantity'],
            'status' => $newProduct['status'],
            'category_id' => $newProduct['category_id'],
            'provider_id' => $newProduct['provider_id'],
        ]);
    }

    public function test_products_update_cannot_change_the_price()
    {
        $newProduct = Product::factory()->raw();

        $this->put(route('products.update', $this->product), $newProduct)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
            'current_price' => $newProduct['current_price']
        ]);
    }

    public function test_products_destroy()
    {
        $newProduct = Product::factory()->create();

        $this->delete(route('products.destroy', $newProduct))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', $newProduct->toArray());
    }
}
