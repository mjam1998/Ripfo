<?php

namespace App\Enums;

enum AcademicRank:int
{
    case Professor = 1;
    case AssociateProfessor = 2;
    case AssistantProfessor = 3;
    case Coach = 4;
    case Else=5;
}
