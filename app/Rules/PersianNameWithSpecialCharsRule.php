<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PersianNameWithSpecialCharsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match(pattern: '/^[-\\/)(*% آبپتثجچحخدذرزژسشصضطظعغفکقكگلمنوهیئيئءؤءًٌٍَُِّأإآىءيا]+$/', subject: $value)) {
            $fail(__('The :attribute should only contain Persian letters , / - )( *% Characters and spaces.', [$attribute]));
        }
    }
}
