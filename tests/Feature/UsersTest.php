<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var  User
     */
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        $this->signIn(
            User::factory()->admin()->create(['country_id'=>$this->user->country_id])
        );
    }

    public function test_users_crud_is_limited_to_auth_users()
    {
        //Unauthenticated user
        auth()->logout();

        //Users index
        $this->get(route('users.index'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //User create
        $this->get(route('users.create'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //User store
        $this->post(route('users.store'), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //User edit
        $this->get(route('users.edit', $this->user))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //User update
        $this->put(route('users.update', $this->user), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
        //User delete
        $this->delete(route('users.destroy', $this->user))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Non admin user
        $this->signIn();

        //Users index
        $this->get(route('users.index'))->assertStatus(Response::HTTP_FORBIDDEN);
        //User create
        $this->get(route('users.create'))->assertStatus(Response::HTTP_FORBIDDEN);
        //User store
        $this->post(route('users.store'), [])->assertStatus(Response::HTTP_FORBIDDEN);
        //User edit
        $this->get(route('users.edit', $this->user))->assertStatus(Response::HTTP_FORBIDDEN);
        //User update
        $this->put(route('users.update', $this->user), [])->assertStatus(Response::HTTP_FORBIDDEN);
        //User delete
        $this->delete(route('users.destroy', $this->user))->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_users_index()
    {
        $this->get(route('users.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Users/Index')
                ->has('users', 2)
            );
    }

    public function test_users_create_page()
    {
        $this->get(route('users.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Users/Create')
                ->has('countries')
            );
    }

    public function test_users_store()
    {
        $newUser = User::factory()->raw([
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

        $this->post(route('users.store'), $newUser)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 3);
    }

    public function test_users_edit()
    {
        $this->get(route('users.edit', $this->user))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Users/Edit')
                ->has('countries')
                ->has('user', fn(Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->where('name', $this->user->name)
                    ->etc()
                )
            );
    }

    public function test_users_update()
    {
        $newUser = User::factory()->raw(['password'=>null]); //this will leave the password unchanged

        $this->put(route('users.update', $this->user), $newUser)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users',[
            'id' => $this->user->id,
            'name' => $newUser['name'],
            'address' => $newUser['address'],
            'password' => $this->user->password // left unchanged
        ]);
    }

    public function test_users_destroy()
    {
        $newUser = User::factory()->create();

        $this->delete(route('users.destroy', $newUser))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', $newUser->toArray());
    }

    public function test_users_cannot_delete_themselves()
    {
        $this->delete(route('users.destroy', auth()->user()))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('flash.message', 'Δεν μπορείτε να διαγράψετε τον εαυτό σας');

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', auth()->user()->only('id'));
    }
}
