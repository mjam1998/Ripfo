<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class AlphabetRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[a-zA-Z آبپتثجچحخدذرزژسشصضطظعغفقکكگلمنوهیئيئءؤءًٌٍَُِّأإآىءيا]+$/', $value)) {
            $fail(__('The :attribute should only contain Persian letters , English letters and spaces.', [$attribute]));
        }
    }
}
