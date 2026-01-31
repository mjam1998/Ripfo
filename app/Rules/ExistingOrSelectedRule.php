<?php

namespace Modules\Base\App\Rules;

use Closure;
use Dornica\Foundation\Core\Enums\IsActive;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\PotentiallyTranslatedString;

class ExistingOrSelectedRule implements ValidationRule
{
    protected Model $model;
    protected string $relation;
    protected Model $currentModel;
    protected bool $disallowSelf;

    public function __construct(string $modelClass, string $relation, Model $currentModel, bool $disallowSelf = false)
    {
        $this->model = new $modelClass;
        $this->relation = $relation;
        $this->currentModel = $currentModel;
        $this->disallowSelf = $disallowSelf;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->disallowSelf && $value == $this->currentModel->id) {
            $fail(__('validation.exists'));
        }

        // Check if value already exists in the current model relation (even if trashed/inactive)
        if (
            $this->currentModel->{$this->relation}()
                ->withTrashed()
                ->where($this->model->getTable() . '.id', $value)
                ->exists()
        ) {
            return;
        }

        // Otherwise check it's active and not trashed
        $exists = $this->model
            ->newQuery()
            ->where('id', $value)
            ->whereNull('deleted_at')
            ->where('is_active', IsActive::YES)
            ->exists();

        if (!$exists) {
            $fail(__('validation.exists'));
        }
    }
}
