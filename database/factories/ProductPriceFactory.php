<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numerify('###.##'),
            'datetime' => now()->subDays($this->faker->numberBetween(1,30))->timestamp,
            'product_id' => function(){
                return Product::factory()->create()->id;
            },
        ];
    }
}
