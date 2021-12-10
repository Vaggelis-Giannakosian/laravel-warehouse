<?php

namespace Tests\Feature;

use App\Models\ProductPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductPricesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var  ProductPrice
     */
    private ProductPrice $price;

    protected function setUp(): void
    {
        parent::setUp();
        $this->price = ProductPrice::factory()->create();
        $this->signIn();
    }

    public function test_prices_crud_is_limited_to_auth_users()
    {
        //Unauthenticated price
        auth()->logout();

        //ProductPrices index
        $this->post(route('prices.store',$this->price->product),[])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //ProductPrice update
        $this->put(route('prices.update', [$this->price->product,$this->price]), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //ProductPrice delete
        $this->delete(route('prices.destroy',  [$this->price->product,$this->price]))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
    }

    public function test_prices_store()
    {
        $newProductPrice = ProductPrice::factory()->raw([
            'product_id' => $this->price->product_id,
            'datetime' => now()
        ]);

        $this->post(route('prices.store',$this->price->product), $newProductPrice)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.edit',$this->price->product));

        $this->assertDatabaseCount('product_prices', 3);
    }


    public function test_prices_update()
    {
        $udpatedProductPrice = ProductPrice::factory()->raw([
            'datetime' => now(),
            'product_id' => $this->price->product_id
        ]);

        $this->put(route('prices.update', [$this->price->product,$this->price]), $udpatedProductPrice)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.edit',$this->price->product));

        $this->assertDatabaseCount('product_prices', 2);
        $this->assertDatabaseHas('product_prices',[
            'id' => $this->price->id,
            'price' => $udpatedProductPrice['price'],
        ]);
    }

    public function test_prices_destroy()
    {
        $this->delete(route('prices.destroy', [$this->price->product,$this->price]))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('products.edit',$this->price->product));

        $this->assertDatabaseMissing('product_prices', $this->price->product->toArray());
    }
}
