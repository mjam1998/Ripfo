<?php

namespace Modules\Base\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FileCheck implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $maxSize = 1024;
        $phpMaxSize = config("dornica-base.php_max_file_size");
        if (config("dornica-base.file.max_file_size") >= $phpMaxSize)
            $maxSize = config("dornica-base.file.max_file_size");
        else
            $maxSize = $phpMaxSize;

        if ($value->getSize() / 1024 > $maxSize)
            $fail("فایل اپلود شده بیش از حجم مجاز است");
    }
}
