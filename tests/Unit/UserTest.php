<?php

namespace Tests\Unit;


use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @var User
     */
    private User $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();
    }

    public function test_user_country_relation(){
          $this->assertInstanceOf(BelongsTo::class,$this->user->country());
          $this->assertInstanceOf(Country::class,$this->user->country);
    }

    public function test_password_hash_mutator(){
        $newUser = User::factory()->create([
            'password' => 'password'
        ]);

        $this->assertNotEquals('password',$newUser->password);
        $this->assertTrue(Hash::check('password',$newUser->password));
    }

    public function test_registration_date_is_casted_to_datetime(){
        $this->assertInstanceOf(Carbon::class,$this->user->registration_date);
    }
}
