<?php

namespace Modules\Base\App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class DynamicRule implements ValidationRule
{
    protected array $rules;
    protected ?FormRequest $formRequest;

    public function __construct(FormRequest $formRequest, string ...$rules)
    {
        $this->rules = $rules;
        $this->formRequest = $formRequest;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $validator = Validator::make(
            [$attribute => $value],
            [$attribute => $this->rules],
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );

        if ($validator->fails()) {
            $fail($validator->errors()->first($attribute));
        }
    }
}
