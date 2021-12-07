<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Models\Provider;

class ProductController extends Controller
{

    public function __construct()
    {
        //TODO add permissions accordingly to ProductPolicy
        $this->authorizeResource(Product::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Products/Index',[
            'products' => Product::with(['provider','category'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Products/Create',[
           'categories' => ProductCategory::all()->pluck('name','id'),
           'providers' => Provider::all()->pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        Product::create(array_merge(
            $request->validated(),
            ['current_price' => round($request->current_price,2)]
        )); // the product created observer will add the new price entry
        flash('Το προϊόν δημιουργήθηκε επιτυχώς');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->loadMissing(['category','provider','prices']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function edit(Product $product)
    {
        return inertia('Products/Edit',[
            'product' => $product->loadMissing(['category','provider','prices'=>fn($q)=>$q->latest('datetime')]),
            'categories' => ProductCategory::all()->pluck('name','id'),
            'providers' => Provider::all()->pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        flash('Το προϊόν ενημερώθηκε επιτυχώς');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        flash('Το προϊόν διαγράφτηκε επιτυχώς');
        return back();
    }
}
