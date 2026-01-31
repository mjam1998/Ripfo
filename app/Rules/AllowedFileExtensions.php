<?php

namespace Modules\Base\App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class AllowedFileExtensions implements ValidationRule
{
    protected array $allowedExtensions;

    protected const DEFAULT_EXTENSIONS = [
        'jpg',
        'jpeg',
        'png',
        'pdf',
        'doc',
        'docx',
        'pdf',
        'xls',
        'xlsx',
        'zip',
        'rar',
    ];

    public function __construct(?array $allowedExtensions = null)
    {
        $this->allowedExtensions = $allowedExtensions ?? self::DEFAULT_EXTENSIONS;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $extensions = explode(',', $value);

        // Validate each extension
        foreach ($extensions as $ext) {
            $ext = strtolower(trim($ext));
            if (!in_array($ext, $this->allowedExtensions, true)) {
                $fail("The $attribute contains invalid file extensions. Allowed: " . implode(', ', $this->allowedExtensions));
                return; // Stop further execution after first failure
            }
        }
    }
}
