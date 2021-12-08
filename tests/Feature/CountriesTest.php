<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $country;

    protected function setUp(): void
    {
        parent::setUp();
        $this->country = Country::factory()->create();
        $user = User::factory()->create(['country_id' => $this->country->id]);
        $this->signIn($user);
    }

    public function test_countries_crud_is_limited_to_auth_users()
    {
        auth()->logout();

        //Countries index
        $this->get(route('countries.index'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Country create
        $this->get(route('countries.create'))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Country store
        $this->post(route('countries.store'), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Country edit
        $this->get(route('countries.edit', $this->country))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Country update
        $this->put(route('countries.update', $this->country), [])->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');

        //Country delete
        $this->delete(route('countries.destroy', $this->country))->assertStatus(Response::HTTP_FOUND)->assertRedirect('/login');
    }


    public function test_countries_index()
    {
        $this->get(route('countries.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(function (Assert $page) {
                $page->component('Countries/Index')
                    ->has('countries', 1,fn(Assert $page)=>$page
                        ->where('id',$this->country->id)
                        ->etc()
                    );
            });
    }

    public function test_countries_create_page()
    {
        $this->get(route('countries.create'))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(function (Assert $page) {
                $page->component('Countries/Create');
            });
    }


    public function test_countries_store()
    {
        $newCountry = Country::factory()->raw();

        $this->post(route('countries.store'),$newCountry)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('countries.index'));

        $this->assertDatabaseCount('countries',2);
    }

    public function test_countries_unique_code_on_store()
    {
        $this->post(route('countries.store'),$this->country->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('countries',1);
    }

    public function test_countries_edit()
    {
        $this->get(route('countries.edit', $this->country))
            ->assertStatus(Response::HTTP_OK)
            ->assertInertia(function (Assert $page) {
                $page->component('Countries/Edit')
                    ->has('country', fn(Assert $page) => $page
                        ->where('id', $this->country->id)
                        ->where('name', $this->country->name)
                        ->where('code', $this->country->code)
                        ->etc()
                    );
            });
    }


    public function test_countries_update()
    {
        $newCountry = Country::factory()->raw();

        $this->put(route('countries.update', $this->country),$newCountry)
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('countries.index'));

        $this->assertDatabaseCount('countries',1);
        $this->assertDatabaseHas('countries',$newCountry);
    }

    public function test_countries_destroy()
    {
        $newCountry = Country::factory()->create();

        $this->delete(route('countries.destroy',$newCountry))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('countries.index'));

        $this->assertDatabaseMissing('countries',$newCountry->toArray());
    }

    public function test_countries_with_associated_users_cannot_be_deleted()
    {
        $this->delete(route('countries.destroy',$this->country))
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('countries.index'))
            ->assertSessionHas('flash.message','Η χώρα δεν μπορεί να διαγραφτεί λόγω συσχετισμένων χρηστών');

        $this->assertDatabaseCount('countries',1);
        $this->assertDatabaseHas('countries',$this->country->only('id'));
    }
}
