<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $routeUser = $this->route('user');

        return [
            'username' => ['required','string','max:255',Rule::unique('users','username')->when(!empty($routeUser),fn($q)=>$q->ignore($routeUser->id))],
            'password' => [Rule::requiredIf(empty($routeUser)),'nullable','string','max:255','confirmed'],
            'name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'address' => ['required','string'],
            'email' => ['required','email','max:255',Rule::unique('users')->when(!empty($routeUser),fn($q)=>$q->ignore($routeUser->id))],
            'status' => ['required','string',Rule::in(User::USER_STATUS)],
            'is_admin' => ['boolean'],
            'country_id' => ['required','integer',Rule::exists('countries','id')],
        ];
    }
}
