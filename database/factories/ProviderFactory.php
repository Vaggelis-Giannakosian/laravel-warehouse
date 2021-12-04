<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(10),
            'address' => $this->faker->address(),
            'phone1' => $this->faker->phoneNumber(),
            'phone2' => $this->faker->phoneNumber(),
            'fax' => $this->faker->phoneNumber(),
            'country_id' => function(){
                return Country::factory()->create()->id;
            },
        ];
    }
}
