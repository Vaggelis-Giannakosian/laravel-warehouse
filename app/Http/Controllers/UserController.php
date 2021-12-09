<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Users/Index',[
            'users' => User::with('country:id,name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Users/Create',[
            'countries' => Country::all()->pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        User::create(array_merge(
            $request->validated(),
            [
                'registration_date' => now()->timestamp
            ]
        ));

        flash('Ο χρήστης δημιουργήθηκε επιτυχώς');
        return redirect()->route('users.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(User $user)
    {
        return inertia('Users/Edit',[
            'user' => $user,
            'countries' => Country::all()->pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        flash('Ο χρήστης ενημερώθηκε επιτυχώς');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if(auth()->user()->is($user)){
            flash('Δεν μπορείτε να διαγράψετε τον εαυτό σας','danger');
            return redirect()->route('users.index');
        }


        $user->delete();
        flash("Ο χρήστης διαγράφτηκε επιτυχώς",'danger');
        return redirect()->route('users.index');
    }
}
