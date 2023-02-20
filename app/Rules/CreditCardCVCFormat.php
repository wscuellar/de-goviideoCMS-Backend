<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardCVCFormat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $regex = '/^([0-9]{4}|[0-9]{3})$/';
        //$regex = '^(0[1-9]|1[0-2])\/?(([0-9]{4}|[0-9]{2})$)';
        return preg_match($regex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Formato no válido';
    }
}
