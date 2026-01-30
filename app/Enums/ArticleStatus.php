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

}
