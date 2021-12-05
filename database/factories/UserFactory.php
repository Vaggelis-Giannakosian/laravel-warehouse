<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => User::STATUS_ACTIVE,
            'registration_date' => now()->timestamp,

            'username' => $this->faker->unique()->userName(),
            'password' => 'password', // password

            'is_admin' => false,
            'remember_token' => Str::random(10),
            'country_id' => function(){
                return Country::factory()->create()->id;
            }
        ];
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'status'  => User::STATUS_INACTIVE
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => 'admin',
                'password' => 'password',
                'email' => 'admin@mail.com',
                'is_admin' => true
            ];
        });
    }
}
