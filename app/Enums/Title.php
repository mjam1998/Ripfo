<?php

namespace App\Enums;

enum Title:int
{
    case Dr=1;
   case Mr=2;
   case Mrs=3;
    public function falabel(): string
    {
        return match ($this) {
            self::Dr  => 'دکتر',
            self::Mr  => 'آقای',
            self::Mrs => 'خانم',
        };
    }

}
