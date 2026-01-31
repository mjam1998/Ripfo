<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        [$min, $max] = getPasswordLength();

        if (!(strlen($value) >= $min &&
            strlen($value) <= $max &&
            preg_match('/[A-Z]/', $value) &&
            preg_match('/[a-z]/', $value) &&
            preg_match('/\d/', $value) &&
            preg_match('/[^a-zA-Z\d]/', $value))) {
            $fail(__('Please enter a password consisting of a combination of numbers, Latin letters, and special characters, with a minimum of :minimum characters and a maximum of :maximum characters.',
                ['minimum' => $min, 'maximum' => $max]));
        }
    }
}
