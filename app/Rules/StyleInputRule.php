<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class StyleInputRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[\w\#\-]+$/', $value)) {
            $fail(__('استایل باید فقط شامل اعداد، حروف لاتین، خط تیره (-)، زیرخط (_) و شارپ (#) باشد.', [$attribute]));
        }
    }
}
