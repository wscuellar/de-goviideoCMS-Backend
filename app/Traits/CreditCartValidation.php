
<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait CreditCardValidation
{

    function validate_cc($ccNum, $type = 'all', $regex = null) {

        $ccNum = str_replace(array('-', ' '), '', $ccNum);
        if (mb_strlen($ccNum) < 13) {
            return false;
        }

        if ($regex !== null) {
            if (is_string($regex) && preg_match($regex, $ccNum)) {
                return true;
            }
            return false;
        }

        $cards = array(
            'all' => array(
                'amex'		=> '/^3[4|7]\\d{13}$/',
                'bankcard'	=> '/^56(10\\d\\d|022[1-5])\\d{10}$/',
                'diners'	=> '/^(?:3(0[0-5]|[68]\\d)\\d{11})|(?:5[1-5]\\d{14})$/',
                'disc'		=> '/^(?:6011|650\\d)\\d{12}$/',
                'electron'	=> '/^(?:417500|4917\\d{2}|4913\\d{2})\\d{10}$/',
                'enroute'	=> '/^2(?:014|149)\\d{11}$/',
                'jcb'		=> '/^(3\\d{4}|2100|1800)\\d{11}$/',
                'maestro'	=> '/^(?:5020|6\\d{3})\\d{12}$/',
                'mc'		=> '/^5[1-5]\\d{14}$/',
                'solo'		=> '/^(6334[5-9][0-9]|6767[0-9]{2})\\d{10}(\\d{2,3})?$/',
                'switch'	=>
                '/^(?:49(03(0[2-9]|3[5-9])|11(0[1-2]|7[4-9]|8[1-2])|36[0-9]{2})\\d{10}(\\d{2,3})?)|(?:564182\\d{10}(\\d{2,3})?)|(6(3(33[0-4][0-9])|759[0-9]{2})\\d{10}(\\d{2,3})?)$/',
                'visa'		=> '/^4\\d{12}(\\d{3})?$/',
                'voyager'	=> '/^8699[0-9]{11}$/'
            ),
            'fast' =>
            '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/'
        );

    if (is_array($type)) {
        foreach ($type as $value) {
            $regex = $cards['all'][strtolower($value)];

            if (is_string($regex) && preg_match($regex, $ccNum)) {
                return true;
            }
        }
    } elseif ($type === 'all') {
        foreach ($cards['all'] as $value) {
            $regex = $value;

            if (is_string($regex) && preg_match($regex, $ccNum)) {
                return true;
            }
        }
    } else {
        $regex = $cards['fast'];

        if (is_string($regex) && preg_match($regex, $ccNum)) {
            return true;
        }
    }
    return false;
    }
}
