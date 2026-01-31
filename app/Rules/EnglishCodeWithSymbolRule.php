<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class EnglishCodeWithSymbolRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!empty($value)) {
            if (!preg_match('/^[-a-zA-Z0-9_]+$/u', $value)) {
                $fail(__('The :attribute should only contain English letters, numbers, "-" and "_".', [$attribute]));
            }
        }
    }
}
