<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueFlagRule implements ValidationRule
{
    protected string $field;
    protected Builder $query;
    protected int|string $expectedValue;
    protected ?int $ignoreId;

    public function __construct(
        string         $field,
        Builder|string $modelOrBuilder,
        int|string     $expectedValue,
        ?int           $ignoreId = null,
    )
    {
        $this->field = $field;
        $this->expectedValue = $expectedValue;
        $this->ignoreId = $ignoreId;

        if (is_string($modelOrBuilder)) {
            $model = new $modelOrBuilder;
            $this->query = $model->newQuery();
        } else {
            $this->query = $modelOrBuilder;
        }
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->expectedValue) {
            $query = $this->query->where($this->field, $this->expectedValue);

            if ($this->ignoreId !== null) {
                $query->where('id', '!=', $this->ignoreId);
            }

            if ($query->exists()) {
                $fail(__(':attribute already exists.', [$attribute]));
            }
        }
    }
}
