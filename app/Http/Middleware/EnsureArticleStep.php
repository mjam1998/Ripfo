<?php

namespace App\Http\Middleware;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureArticleStep
{

    /*public function handle($request, Closure $next, $step)
    {
        $article = $request->route('article');



        if ($article->user_id !== auth()->id()) {
            abort(403, 'شما دسترسی به این مقاله را ندارید.');
        }
        if($article->status==ArticleStatus::SendedReview
            ||$article->status==ArticleStatus::EditedReview
            ||$article->status==ArticleStatus::Cancel
            ||$article->status==ArticleStatus::AcceptedFinalReview
            ||$article->status==ArticleStatus::Accepted
            ||$article->status==ArticleStatus::Rejected

    ){
            abort(403, ' اجازه ویرایش مقاله را ندارید.');
    }
        if ($article->step < $step) {
            return redirect()
                ->back()
                ->with('error', 'ابتدا مراحل قبلی مقاله را تکمیل کنید.');
        }

        return $next($request);
    }*/
    public function handle($request, Closure $next, $step)
    {
        $article = $request->route('article');

        // اگر Model نیست (string/int هست)، از DB بگیر
        if (!$article instanceof Article) {
            $article = Article::findOrFail($article);
        }

        if ($article->user_id !== auth()->id()) {
            abort(403, 'شما دسترسی به این مقاله را ندارید.');
        }

        if (in_array($article->status, [
            ArticleStatus::SendedReview,
            ArticleStatus::EditedReview,
            ArticleStatus::Cancel,
            ArticleStatus::waitingAcceptCoWriters,
            ArticleStatus::AcceptedFinalReview,
            ArticleStatus::Accepted,
            ArticleStatus::Rejected,
        ])) {
            abort(403, 'اجازه ویرایش مقاله را ندارید.');
        }

        if ($article->step < $step) {
            return redirect()
                ->back()
                ->withErrors(['ابتدا مراحل قبلی مقاله را تکمیل کنید.']);
        }

        return $next($request);
    }

}
