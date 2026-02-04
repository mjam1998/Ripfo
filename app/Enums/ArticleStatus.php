<?php

namespace App\Enums;

enum ArticleStatus:int
{
    case SendedReview=0;
    case NeedReSend=1;
    case NeedEdit=2;
    case EditedReview=3;
    case Cancel=4;
    case AcceptedFinalReview=5;
    case Accepted=6;
    case Rejected=7;
    public function falabel(): string
    {
        return match ($this) {
            self::SendedReview  => ' ارسال شده/در حال بررسی',
            self::NeedReSend  => ' نیازمند ارسال دوباره',
            self::NeedEdit => ' نیازمند بازنگری',
            self::EditedReview  => 'بازنگری شده/درحال بررسی',
            self::Cancel  => 'لغو شده توسط نویسنده',
            self::AcceptedFinalReview  => 'پذیرفته شده بررسی فایل های نهایی قبل از انتشار',
            self::Accepted  => 'تایید و منتشر شده',
            self::Rejected  => 'رد شده',
        };
    }

}
