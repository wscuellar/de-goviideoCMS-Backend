<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardNumberFormat implements Rule
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

        $test_cc = array(
            '', // in valid
            '34534trdsgfdgdfxgfdg3w653w45', // in valid
            '378282246310005', // valid
            '371449635398431', // valid
            '134449635398431', // in valid
            '6011111111111117',// valid
            '5105105105105100', // valid
            '4222222222222', // valid
            '4012888888881881', // valid
            'asdfasdsadsadsdas', // in valid
            '30569309025904', // valid
            '3530111333300000',  // valid
            '12345678912345',  // in valid
            '4070912798591', // valid
            '4716699760542841', // valid
            '3528503483993101',  // valid
            '180000193805365',  // valid
        );

        $regex = '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/';
        return preg_match($regex, $value);
    }



    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Formato de tarjeta no válido';
    }
}
