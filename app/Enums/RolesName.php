<?php

namespace App\Enums;

enum RolesName:string
{
    case writer='نویسنده';
    case juror='داور';
    case admin='ادمین';
    public static function fromRole(string $roleName): string
    {
        return self::tryFromName($roleName)?->value ?? $roleName;
    }

    private static function tryFromName(string $name): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }
        return null;
    }
}
