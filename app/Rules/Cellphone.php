<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Cellphone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str_replace("-", "", $value);
        $blacklist = ["09000000000", "09111111111", "09222222222", "09333333333", "09444444444", "09555555555", "09666666666", "09777777777", "09888888888", "09999999999"];
        if (!preg_match("/^09[0-9]{9}$/", $value) || in_array($value, $blacklist))
            $fail(__('validation.cellphone'));
    }

}
