<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Modules\GeographicInformation\App\Models\City;

class CityAndProvinceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $province = request('province_id');
        $city = City::find($value);

        if ($city->province->id != $province)
            $fail(__('validation.attributes.city_province_not_match'));

    }
}
