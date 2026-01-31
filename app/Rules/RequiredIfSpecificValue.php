<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RequiredIfSpecificValue implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    protected $specificField;
    protected $specificValue;

    public function __construct($specificField, $specificValue)
    {
        $this->specificField = $specificField;
        $this->specificValue = $specificValue;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $specificFieldValue = request($this->specificField);

        if ($specificFieldValue != $this->specificValue && !empty($value))
            $fail(__('validation.nationalcode'));

    }

    public function message()
    {
        return 'The :attribute field is required .';
    }
}
