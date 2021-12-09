<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Categories/Index',[
           'categories' => ProductCategory::withCount('products')->orderBy('ordering')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ordering' => 'nullable|integer',
        ]);

        ProductCategory::create($validatedData);
        flash('Η κατηγορία δημιουργήθηκε επιτυχώς');
        return redirect(route('categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(ProductCategory $category)
    {
        return inertia('Categories/Edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, ProductCategory $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ordering' => 'nullable|integer',
        ]);

        $category->update($validatedData);
        flash('Η κατηγορία ενημερώθηκε επιτυχώς');
        return redirect(route('categories.index'));
    }

    public function updateOrder(Request $request,ProductCategory $category)
    {
        $validated = $request->validate([
            'ordering' => 'required|integer'
        ]);

        $category->update($validated);

        flash('Η σειρά ταξινόμησης της κατηγορίας ενημερώθηκε επιτυχώς');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ProductCategory $category)
    {
        if($category->products()->count()) {
            flash('Η κατηγορία δεν μπορεί να διαγραφτεί λόγω συσχετισμένων προϊόντων', 'danger');
            return redirect()->route('categories.index');
        }

        $category->delete();
        flash('Η κατηγορία διαγράφτηκε επιτυχώς');
        return redirect()->route('categories.index');
    }
}
