<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PersianNameWithSlashRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/^[آبپتثجچحخدذرزژسشصضطظعغفقکكگلمنوهیئيئءؤءًٌأإآىءيا\s\/]+$/u', $value)) {
            $fail(__("The :attribute should only contain Persian letters, spaces, and slash (/).", [$attribute]));
        }
    }
}
