<?php

namespace App\Http\Requests;

use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:255',
            'address'=> 'required|string',
            'description'=> 'required|string',
            'phone1'=> ['required', new ValidPhoneNumber()],
            'phone2'=> ['nullable', new ValidPhoneNumber()],
            'fax '=> ['nullable', new ValidPhoneNumber()],
            'country_id' => ['required','integer',Rule::exists('countries','id')]
        ];
    }
}
