<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^0[1-8]{2,}[0-9]{4,}$/', $value)) {
            $fail(__('The :attribute must be at least 7 and at most 11 digits along with the city code.', [$attribute]));
        }
    }
}
