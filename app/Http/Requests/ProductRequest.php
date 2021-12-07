<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routeProduct = $this->route('product');

        return [
            'name' => ['required','string','max:255'],
            'ska' => ['required','string','max:255',Rule::unique('products','ska')->when(!empty($routeProduct),fn($q)=>$q->ignore($routeProduct->id))],
            'current_price' => [Rule::requiredIf(empty($routeProduct)),'numeric','gte:0'],
            'quantity' => ['required','numeric'],
            'status' => ['required','string',Rule::in(Product::PRODUCT_STATUS)],
            'provider_id' => ['required','integer',Rule::exists('providers','id')],
            'category_id' => ['required','integer',Rule::exists('product_categories','id')],
        ];
    }
}
