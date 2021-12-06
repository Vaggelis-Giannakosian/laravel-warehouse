<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Models\Country;
use App\Models\Provider;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Providers/Index',[
            'providers' => Provider::withCount('products')->with('country:id,name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Providers/Create',[
            'countries' => Country::all()->pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProviderRequest $request)
    {
        Provider::create($request->all());
        flash("Ο προμηθευτής δημιουργήθηκε επιτυχώς");
        return redirect()->route('providers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Provider $provider)
    {
        return inertia('Providers/Edit',[
            'provider'=> $provider,
            'countries' => Country::all()->pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        flash("Ο προμηθευτής ενημερώθηκε επιτυχώς");
        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Provider $provider)
    {
        if($provider->products()->exists())
        {
            flash('Ο προμηθευτής δεν μπορεί να διαγραφτεί λόγω συσχετισμένων προϊόντων','danger');
            return back();
        }

        $provider->delete();
        flash('O προμηθευτής διαγράφτηκε επιτυχώς');
        return back();
    }
}
