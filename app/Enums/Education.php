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

    public function falabel(): string
    {
        return match ($this) {
            self::DrTechnical  => 'دکترای تخصصی',
            self::DrMedical  => 'دکترای پزشکی',
            self::PhdStudent => 'دانشجوی دکتری',
            self::MasterDegree  => 'کارشناسی ارشد',
            self::MasterDegreeStudent  => 'دانشجوی ارشد',
            self::BachelorDegree  => 'کارشناسی',
            self::Else  => 'سایر',
        };
    }

}
