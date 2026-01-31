<?php

namespace Modules\Base\App\Rules;

use Closure;
use Dornica\Foundation\Core\Enums\IsActive;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;
use Modules\GeographicInformation\App\Models\VillageDocumentType;

class ValidVillageDocumentTypeRule implements ValidationRule
{
    protected ?int $id;

    /**
     * Constructor to optionally accept an ID (for update scenarios)
     */
    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = VillageDocumentType::query()
            ->where('is_active', IsActive::YES->value)
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->whereHas('fileType');

        if ($this->id) {
            $query->orWhere('id', $this->id);
        }

        $exists = $query->exists();

        if (!$exists) {
            $fail(__('The selected :attribute is not currently available or is inactive.', [
                'attribute' => $attribute,
            ]));
        }
    }
}
