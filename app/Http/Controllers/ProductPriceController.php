<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{

    public function store(Request $request, Product $product){

        $validated = $request->validate([
            'price' => ['required','numeric'],
            'datetime' => ['required','date','before_or_equal:now']
        ]);
        $datetime = Carbon::parse($validated['datetime'])->timestamp;

        ProductPrice::create([
            'price' => round($validated['price'],2),
            'datetime' => $datetime,
            'product_id' => $product->id
        ]);

        return redirect()->route('products.edit',$product);
    }

    public function update(Request $request, Product $product, ProductPrice $price)
    {
        $validated = $request->validate([
            'price' => ['required','numeric'],
            'datetime' => ['required','date','before_or_equal:now']
        ]);
        $datetime = Carbon::parse($validated['datetime'])->timestamp;

        $price->update([
            'price' => $validated['price'],
            'datetime' => $datetime
        ]);

        return redirect()->route('products.edit',$product);
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
