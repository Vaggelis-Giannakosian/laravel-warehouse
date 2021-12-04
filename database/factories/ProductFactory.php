<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'ska' => $this->faker->unique()->numerify('###########'),
            'current_price' => $this->faker->numerify('###.##'),
            'quantity' => $this->faker->numberBetween(0,1000),
            'status' => collect(Product::PRODUCT_STATUS)->random(),
            'category_id' => function () {
                return ProductCategory::factory()->create()->id;
            },
            'provider_id' => function () {
                return Provider::factory()->create()->id;
            },
        ];
    }
}
