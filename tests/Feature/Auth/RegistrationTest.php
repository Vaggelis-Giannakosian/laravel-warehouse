<?php

namespace Tests\Feature\Auth;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'last_name' => 'User',
            'address' => "Address",
            'email' => 'test@example.com',
            'username' => 'username',
            'password' => 'password',
            'password_confirmation' => 'password',
            'country_id' => Country::factory()->create()->id
        ]);

        $this->assertFalse(auth()->check());
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
