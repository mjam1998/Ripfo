<?php

namespace App\Enums;

enum ArticleStatus:int
{
    case writing = 0;
    case waitingAcceptCoWriters=1;
    case SendedReview=2;
    case NeedReSend=3;
    case NeedEdit=4;
    case EditedReview=5;
    case Cancel=6;
    case AcceptedFinalReview=7;
    case Accepted=8;
    case Rejected=9;
    public function falabel(): string
    {
        return match ($this) {
            self::waitingAcceptCoWriters  => ' منتطر تایید نویسندگان همکار',
            self::writing  => ' در حال تکمیل',
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
