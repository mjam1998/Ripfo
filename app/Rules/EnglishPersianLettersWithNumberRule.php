<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class EnglishPersianLettersWithNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[a-zA-Z0-9۰-۹ آبپتثجچحخدذرزژسشصضطظعغفقکكگلمنوهیئيئءؤًٌٍَُِّأإآىءيا]+$/u', $value)) {
            $fail(__('The :attribute should only contain Persian letters , English letters and numbers.', [$attribute]));
        }
    }
}
