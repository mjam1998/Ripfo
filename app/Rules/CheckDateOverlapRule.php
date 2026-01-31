<?php

namespace Modules\Base\App\Rules;

use Closure;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class CheckDateOverlapRule implements ValidationRule
{
    protected string $startDate;
    protected string $endDate;
    protected Builder $query;
    protected string $message;
    protected ?int $ignoreId;

    public function __construct(
        string         $startDate,
        string         $endDate,
        Builder|string $modelOrBuilder,
        ?string        $message = null,
        ?int           $ignoreId = null,
    )
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->message = $message ?? 'base::message.check_dates_overlap';
        $this->ignoreId = $ignoreId;

        $this->query = is_string($modelOrBuilder)
            ? (new $modelOrBuilder)->newQuery()
            : $modelOrBuilder;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $from = Verta::parse($this->startDate)->toCarbon()->format('Y-m-d');
            $to = Verta::parse($this->endDate)->toCarbon()->format('Y-m-d');

            if ($this->query->overlappingDates($from, $to, $this->ignoreId)->exists()) {
                $fail(__($this->message));
            }
        } catch (Throwable) {
            $fail(__('base::message.invalid_date_format'));
        }
    }
}
