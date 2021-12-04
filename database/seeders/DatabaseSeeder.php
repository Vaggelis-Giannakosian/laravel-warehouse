<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            UserSeeder::class,
            ProductCategorySeeder::class,
            ProviderSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
