<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ProductCategory::select('id')->get()->pluck('id');
        $providers = Provider::select('id')->get()->pluck('id');

        foreach(range(1,30) as $index)
        {
            $product = Product::factory()->create([
                'category_id' => $categories->random(),
                'provider_id' => $providers->random(),
            ]);

            ProductPrice::factory()->count(5)->create([
                'product_id' => $product->id
            ]);
        }

    }
}
