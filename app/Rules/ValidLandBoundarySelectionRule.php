<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Translation\PotentiallyTranslatedString;
use Modules\Project\App\Models\LandBoundaryType;
use Modules\Project\App\Models\LandLocationType;

class ValidLandBoundarySelectionRule implements ValidationRule
{
    protected $landBoundaryTypes;
    protected $landLocationTypes;

    public function __construct()
    {
        $this->landBoundaryTypes = LandBoundaryType::all()->keyBy('code');
        $this->landLocationTypes = LandLocationType::all()->groupBy('land_boundary_type_id');
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $code = Str::after($attribute, 'land_boundary_type_locations_');
        $boundaryType = $this->landBoundaryTypes[$code] ?? null;

        if (!$boundaryType) {
            $fail(__("Invalid land boundary selection."));
            return;
        }

        $validIds = $this->landLocationTypes[$boundaryType->id]->pluck('id')->toArray();

        if (!in_array((int) $value, $validIds)) {
            $fail(__("Invalid land boundary selection."));
        }
    }
}
