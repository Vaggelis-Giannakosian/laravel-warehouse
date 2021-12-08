<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Countries/Index', [
            'countries' => Country::withCount(['users','providers'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Countries/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:countries,code'
        ]);

        Country::create($validatedData);

        flash('Η χώρα δημιουργήθηκε επιτυχώς');

        return redirect(route('countries.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Country $country)
    {
        return inertia('Countries/Edit', [
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required',Rule::unique('countries','code')->ignore($country->id)]
        ]);

        $country->update($validatedData);

        flash('Η χώρα ενημερώθηκε επιτυχώς');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country)
    {
        $message = $country->users()->exists()
            ? 'Η χώρα δεν μπορεί να διαγραφτεί λόγω συσχετισμένων χρηστών'
            : (
                $country->providers()->exists()
                    ? 'Η χώρα δεν μπορεί να διαγραφτεί λόγω συσχετισμένων προμηθευτών'
                    : null
            );

        if($message) {
            flash($message, 'danger');
            return redirect()->route('countries.index');
        }

        $country->delete();
        flash('Η χώρα διαγράφτηκε επιτυχώς');
        return redirect()->route('countries.index');
    }
}
