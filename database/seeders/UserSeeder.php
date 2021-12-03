<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
        $this->createOtherUsers();
    }

    private function createAdmin()
    {
        User::factory()->admin()->create([
            'country_id' => Country::whereCode('GR')->first()->id
        ]);
    }

    private function createOtherUsers()
    {
        $countries = Country::take(10)->get();
        $countries->each(function($country){
            User::factory()->count(2)->create([
                'country_id' => $country->id
            ]) ;
        });
    }
}
