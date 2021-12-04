<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::take(10)->get()->pluck('id')->each(function($countryId){
            Provider::factory()->count(2)->create([
                'country_id' => $countryId
            ]);
        });


    }
}
