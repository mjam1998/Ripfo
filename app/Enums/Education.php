<?php

namespace App\Enums;

enum Education:int
{
    case DrTechnical=1;
    case DrMedical=2;
    case PhdStudent=3;
    case MasterDegree=4;
    case MasterDegreeStudent=5;
    case BachelorDegree=6;
    case Else=7;

}
