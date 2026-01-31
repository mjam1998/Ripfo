<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckMoreThanSpecificField implements ValidationRule
{
    public $specific_field;

    public function __construct($specific_field)
    {
        $this->specific_field = $specific_field;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value < request($this->specific_field))
            $fail(__('The :attribute is not correct.', [$attribute]));
    }
}
