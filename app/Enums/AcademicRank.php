<?php

namespace App\Enums;

enum AcademicRank:int
{
    case Professor = 1;
    case AssociateProfessor = 2;
    case AssistantProfessor = 3;
    case Coach = 4;
    case Else=5;
    public function falabel(): string
    {
        return match ($this) {
            self::Professor  => ' استاد',
            self::AssociateProfessor  => 'دانشیار',
            self::AssistantProfessor => ' استادیار',
            self::Coach  => 'مربی',
            self::Else  => 'سایر',

        };
    }
}
