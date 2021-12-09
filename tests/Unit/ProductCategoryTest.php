<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_products_relation()
    {
        $category = ProductCategory::factory()
            ->has(Product::factory()->count(1))
            ->create();

        $this->assertInstanceOf(HasMany::class, $category->products());
        $this->assertInstanceOf(Collection::class, $category->products);
        $this->assertCount(1, $category->products);
        $this->assertInstanceOf(Product::class, $category->products->first());
    }
}

