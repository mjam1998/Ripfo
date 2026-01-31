<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Nationalcode implements ValidationRule
{
    protected $notNationalCode =
        array("1111111111", "2222222222", "3333333333", "4444444444", "5555555555", "6666666666", "7777777777", "8888888888", "9999999999", "0000000000");

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str_replace("-", "", $value);
        $meli = $value;

        if (in_array($value, $this->notNationalCode))
            $fail(__('validation.nationalcode'));

        $cDigitLast = substr($meli, strlen($meli) - 1);
        $fMeli = strval(intval($meli));

        if ((str_split($fMeli))[0] == "0" && !(8 <= strlen($fMeli) && strlen($fMeli) < 10))
            $fail(__('validation.nationalcode'));

        $nineLeftDigits = substr($meli, 0, strlen($meli) - 1);

        $positionNumber = 10;
        $result = 0;

        foreach (str_split($nineLeftDigits) as $chr) {
            $digit = intval($chr);
            $result += $digit * $positionNumber;
            $positionNumber--;
        }

        $remain = $result % 11;

        $controllerNumber = $remain;

        if (2 <= $remain) {
            $controllerNumber = 11 - $remain;
        }

        if ($cDigitLast != $controllerNumber)
            $fail(__('validation.nationalcode'));
    }
}




