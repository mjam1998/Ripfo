<?php

namespace Modules\Base\App\Rules;

use Closure;
use Dornica\Foundation\Core\Enums\IsActive;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SameStatusRule implements ValidationRule
{
    protected bool|null $field;

    public function __construct(bool|null $field)
    {
        $this->field = $field;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == IsActive::YES->value && $this->field == IsActive::YES->value) {
            $fail(__('A record cannot be in both start and end status'));
        }
    }
}
