<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match(
            '/^\+?(?:30|00)?(?:69\d{8}|2\d{9})/',
            str_replace(' ','',$value)) // remove empty spaces for the regex to run
        ){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Πρέπει να εισάγετε έγκυρο αριθμό τηλεφώνου.';
    }
}
