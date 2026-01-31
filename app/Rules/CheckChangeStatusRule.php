<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Base\App\Enums\General\IsEnd;
use Modules\Base\App\Enums\General\StatusType;

class CheckChangeStatusRule implements ValidationRule
{
    protected $model;
    protected $statusField;
    protected $statusModelClass;
    protected $statusRelation;
    protected $attributeName;

    public function __construct(
        object $model,
        string $statusField,
        string $statusRelation,
        string $statusModelClass,
        string $attributeName,
    )
    {
        $this->model = $model;
        $this->statusField = $statusField;
        $this->statusModelClass = $statusModelClass;
        $this->statusRelation = $statusRelation;
        $this->attributeName = $attributeName;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $roleId = authenticator()->currentRole()->get('id');

        $allowedStatuses = $this->statusModelClass::allowedStatuses(
            $roleId,
            StatusType::CHANGE->value,
            $this->model->{$this->statusField}
        )
            ->pluck('id');

        $statusId = $this->model->{$this->statusField};
        if (!$allowedStatuses->contains($statusId)) {
            $fail(__('base::message.not_allowed_change_status', ['attribute' => $this->attributeName]));
            return;
        }

        $relation = $this->model->{$this->statusRelation};

        if ($relation && $relation->is_end->value == IsEnd::YES->value) {
            $fail(__('base::message.final_status', ['attribute' => $this->attributeName]));
        }
    }
}
