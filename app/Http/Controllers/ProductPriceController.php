<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{

    public function store(Request $request, Product $product){

        $validated = $request->validate([
            'price' => ['required','numeric'],
            'datetime' => ['required','date']
        ]);

        ProductPrice::create([
            'price' => $validated['price'],
            'datetime' => $validated['datetime']
        ]);

        return back();
    }

    public function update(Request $request, Product $product, ProductPrice $price)
    {
        $validated = $request->validate([
            'price' => ['required','numeric'],
            'datetime' => ['required','date']
        ]);

        $price->update([
            'price' => $validated['price'],
            'datetime' => $validated['datetime']
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, ProductPrice $price)
    {
        $this->authorize('update',$product);

        $price->delete(); // the ProductPrice deleted observer will update the product if needed

        flash('Η εγγραφή διαγράφτηκε επιτυχώς');
        return redirect()->route('products.edit',$product);
    }
}
