<?php

namespace App\Http\Controllers;

use App\Enums\AcademicRank;
use App\Enums\ArticleStatus;
use App\Enums\Education;
use App\Enums\Title;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Article;
use App\Models\EducationFiled;
use App\Models\Keyword;
use App\Models\Required;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WriterController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        // دریافت تمام مقالات کاربر
        $articles = $user->articles;

        // محاسبه آمار کلی
        $totalArticles = $articles->count();
        $acceptedCount = $articles->where('status', ArticleStatus::Accepted)->count();
        $reviewingCount = $articles->whereIn('status', [
            ArticleStatus::SendedReview,
            ArticleStatus::EditedReview,
            ArticleStatus::AcceptedFinalReview
        ])->count();
        $rejectedCount = $articles->where('status', ArticleStatus::Rejected)->count();

        // گروه‌بندی بر اساس وضعیت - اصلاح شده
        $articleStatuses = [];
        foreach (ArticleStatus::cases() as $statusEnum) {
            $count = $articles->where('status', $statusEnum)->count();
            if ($count > 0) {
                $articleStatuses[] = [
                    'status' => $statusEnum,
                    'count' => $count
                ];
            }
        }

        return view('panel.writer.index', compact(
            'totalArticles',
            'acceptedCount',
            'reviewingCount',
            'rejectedCount',
            'articleStatuses'
        ));

    }

    public function article()
    {

        $keywords = Keyword::all();


        return view('panel.writer.article', compact('keywords'));
    }

    public function articleStore(StoreArticleRequest $request)
    {
        $writers = $request->input('writers_id');


        $jurorOfferName = null;
        $jurorOfferId = null;
        $code = null;
        if ($request['juror_offer_id'] == 0 && $request->filled('juror_offer_name')) {
            $jurorOfferName = $request['juror_offer_name'];
        }
        if ($request['juror_offer_id'] >= 1) {
            $jurorOfferId = $request['juror_offer_id'];
        }
        do {
            $code = strtolower(Str::random(6));
        } while (Article::where('code', $code)->exists());

        $filePrimaryExtension = $request->file_primary->getClientOriginalExtension();
        $filePrimaryName = $code . "." . $filePrimaryExtension;
        $request->file_primary->storeAs('articles', $filePrimaryName, 'public');
        $fileSecondaryName = null;
        if ($request->hasFile('file_secondary')) {
            $fileSecondaryExtension = $request->file_secondary->getClientOriginalExtension();
            $fileSecondaryName = $code . "." . $fileSecondaryExtension;
            $request->file_secondary->storeAs('attachments', $fileSecondaryName, 'public');
        }
        $article = Article::query()->create([
            'juror_offer_id' => $jurorOfferId,
            'code' => $code,
            'title' => $request['title'],
            'title_en' => $request['title_en'],
            'summary' => $request['summary'],
            'summary_en' => $request['summary_en'],
            'file_primary' => $filePrimaryName,
            'file_secondary' => $fileSecondaryName,
            'status' => ArticleStatus::SendedReview,

        ]);
        if (is_array($writers) && count($writers) > 0) {
            $writers = array_merge($writers, [auth()->user()->id]);
            $article->users()->attach($writers);
        } else {
            $article->users()->attach(auth()->user()->id);
        }
        $article->keywords()->attach($request['keywords_id']);

        return redirect()->back()->with('article_success', 'مقاله با موفقیت درج شد.');
    }

    public function userInformation()
    {
        $user = auth()->user();
        $req = Required::query()->first();
        $isOrcidReq = $req->is_orcid_required;
        return view('panel.information', [
            'titles' => Title::cases(),
            'educations' => Education::cases(),
            'academicRanks' => AcademicRank::cases(),
            'educationFields' => EducationFiled::all(),
            'isOrcidReq' => $isOrcidReq,
            'user' => $user,
        ]);

    }

    public function userInformationUpdate(UpdateUserRequest $request)
    {
        $user = auth()->user();

        $data = $request->except(['password', 'password_confirmation']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->back()
            ->with('information_success', 'بروزرسانی اطلاعات حساب کاربری با موفقیت انجام شد.');
    }

    public function jurorsSearch(Request $request)
    {
        $q = trim($request->q);

        return User::role('juror')
            ->where('id', '!=', auth()->id())
            ->when($q, function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%")
                        ->orWhere('organ', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->limit(20)
            ->get()
            ->map(function ($user) {
                return [
                    'value' => $user->id,
                    'label' => ($user->title?->falabel() ?? '') .
                        ' ' . $user->name . ' - ' . $user->organ,
                ];
            });
    }

    public function searchWriters(Request $request)
    {
        $q = trim($request->q);

        return User::role('writer')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%")
                        ->orWhere('organ', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->limit(20)
            ->get()
            ->map(function ($writer) {
                return [
                    'value' => $writer->id,
                    'label' =>
                        ($writer->title?->falabel() ?? '') .
                        ' ' .
                        $writer->name .
                        ' - ' .
                        $writer->organ,
                ];
            });
    }

    public function search(Request $request)
    {
        $q = trim($request->q);

        return Keyword::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('title', 'like', "%{$q}%")
                        ->orWhere('title_en', 'like', "%{$q}%");
                });
            })
            ->orderBy('title')
            ->limit(20)
            ->get()
            ->map(function ($keyword) {
                return [
                    'value' => $keyword->id,
                    'label' => $keyword->title . ' / ' . $keyword->title_en,
                ];
            });
    }

    public function articles(int $status)
    {
        return view('panel.writer.articles', ['status' => $status]);
    }

    public function articleDetail(string $code)
    {
        $isEdit=false;
        $user = auth()->user();
        $article = $user->articles()->where('code', $code)->firstOrFail();
        if($article->status==ArticleStatus::NeedReSend || $article->status==ArticleStatus::NeedEdit){
         $isEdit=true;
        }
        return view('panel.writer.article-show', ['article' => $article, 'isEdit' => $isEdit]);
    }

    public function articleDownload(string $code)
    {
        $user = auth()->user();
        $article = $user->articles()->where('code', $code)->firstOrFail();
        if (!$article) {
            return redirect()->back()->withErrors(['error' => 'مقاله مورد نظر پیدا نشد.']);
        }
        return response()->download(
            public_path('/articles/' . $article->file_primary)
        );
    }
    public function articleDownloadSecond(string $code)
    {
        $user = auth()->user();
        $article = $user->articles()->where('code', $code)->firstOrFail();
        if (!$article) {
            return redirect()->back()->withErrors(['error' => 'مقاله مورد نظر پیدا نشد.']);
        }


        if (empty($article->file_secondary)) {
            return redirect()->back()->withErrors(['error' => 'فایل پیوست موجود نیست.']);
        }
        return response()->download(
            public_path('/attachments/' . $article->file_secondary)
        );
    }
    public function articleDownloadJuror(string $code)
    {
        $user = auth()->user();
        $article = $user->articles()->where('code', $code)->firstOrFail();
        if (!$article) {
            return redirect()->back()->withErrors(['error' => 'مقاله مورد نظر پیدا نشد.']);
        }


        if (empty($article->juror_file)) {
            return redirect()->back()->withErrors(['error' => 'فایل پیوست داور موجود نیست.']);
        }
        return response()->download(
            public_path('/juror/' . $article->juror_file)
        );
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}


