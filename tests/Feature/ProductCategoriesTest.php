<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var  ProductCategory
     */
    private ProductCategory $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = ProductCategory::factory()->create();
        $this->signIn();
    }

    public function test_categories_crud_is_limited_to_auth_users()
    {
        auth()->logout();

        //Categories index
        $this->get(route('categories.index'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //ProductCategory create
        $this->get(route('categories.create'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //ProductCategory store
        $this->post(route('categories.store'), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //ProductCategory edit
        $this->get(route('categories.edit', $this->category))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //ProductCategory update
        $this->put(route('categories.update', $this->category), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //ProductCategory delete
        $this->delete(route('categories.destroy', $this->category))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
    }

    public function test_categories_index()
    {
        $categoryWithLessOdering = ProductCategory::factory()->create(['ordering' => $this->category->ordering - 1]);

        $this->get(route('categories.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Categories/Index')
                ->has('categories', 2, fn(Assert $page) => $page
                    ->where('id', $categoryWithLessOdering->id)
                    ->where('ordering', (string) $categoryWithLessOdering->ordering)
                    ->etc()

                )
            );
    }

    public function test_categories_create_page()
    {
        $this->get(route('categories.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Categories/Create')
            );
    }

    public function test_categories_store()
    {
        $newProductCategory = ProductCategory::factory()->raw();

        $this->post(route('categories.store'), $newProductCategory)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseCount('product_categories', 2);
    }

    public function test_categories_edit()
    {
        $this->get(route('categories.edit', $this->category))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Categories/Edit')
                ->has('category', fn(Assert $page) => $page
                    ->where('id', $this->category->id)
                    ->where('name', $this->category->name)
                    ->where('description', $this->category->description)
                    ->where('ordering', (string)$this->category->ordering)
                    ->etc()
                )
            );
    }

    public function test_categories_update()
    {
        $newProductCategory = ProductCategory::factory()->raw();

        $this->put(route('categories.update', $this->category), $newProductCategory)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseCount('product_categories', 1);
        $this->assertDatabaseHas('product_categories', $newProductCategory);
    }

    public function test_categories_destroy()
    {
        $newProductCategory = ProductCategory::factory()->create();

        $this->delete(route('categories.destroy', $newProductCategory))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseMissing('product_categories', $newProductCategory->toArray());
    }

    public function test_categories_with_associated_products_cannot_be_deleted()
    {
        $product = Product::factory()->create();

        $this->delete(route('categories.destroy', $product->category))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('flash.message', 'Η κατηγορία δεν μπορεί να διαγραφτεί λόγω συσχετισμένων προϊόντων');

        $this->assertDatabaseCount('product_categories', 2);
        $this->assertDatabaseHas('product_categories', $product->category->only('id'));
    }
}
