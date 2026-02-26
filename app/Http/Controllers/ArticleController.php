<?php

namespace App\Http\Controllers;

use App\Enums\AcademicRank;
use App\Enums\Education;
use App\Enums\Title;
use App\Models\Article;
use App\Models\EducationFiled;
use App\Models\Required;
use App\Models\User;
use App\Rules\Cellphone;
use App\Rules\EnglishNameWithSymbolRule;
use App\Rules\Nationalcode;
use App\Rules\PersianNameRule;
use App\Rules\PhoneRule;
use App\Rules\UserNameRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function createStep1()
    {
        $article=null;
        return view('panel.writer.article.create-step1',['step' => 1,'article'=>$article]);
    }
    public function storeStep1(Request $request){
        $data = $request->validate(
            [
                'title' => [
                    'required',
                    'max:300',
                    new PersianNameRule(),
                ],
                'title_en' => [
                    'required',
                    'max:300',
                    new EnglishNameWithSymbolRule(),
                ],
            ],
            [
                'title.required' => 'وارد کردن عنوان مقاله الزامی است.',
                'title.max' => 'عنوان مقاله نباید بیشتر از ۳۰۰ کاراکتر باشد.',

                'title_en.required' => 'وارد کردن عنوان انگلیسی الزامی است.',
                'title_en.max' => 'عنوان انگلیسی نباید بیشتر از ۳۰۰ کاراکتر باشد.',
            ]
        );
        $article=Article::query()->create($data);
        $article->update([
            'step'=>2,
            'user_id'=>auth()->id()
        ]);
        $article->users()->attach(auth()->id(), [
            'sort' => 1,
            'is_confirm' => 1,
        ]);
        return redirect()->route('writer.article.create.step-2',['article'=>$article]);
    }
    public function editStep1(Article $article)
    {
        return view('panel.writer.article.edit-step1',['step' => 1,'article'=>$article]);
    }
    public function updateStep1(Request $request,Article $article)
    {

        $data = $request->validate(
            [
                'title' => [
                    'required',
                    'max:300',
                    new PersianNameRule(),
                ],
                'title_en' => [
                    'required',
                    'max:300',
                    new EnglishNameWithSymbolRule(),
                ],
            ],
            [
                'title.required' => 'وارد کردن عنوان مقاله الزامی است.',
                'title.max' => 'عنوان مقاله نباید بیشتر از ۳۰۰ کاراکتر باشد.',

                'title_en.required' => 'وارد کردن عنوان انگلیسی الزامی است.',
                'title_en.max' => 'عنوان انگلیسی نباید بیشتر از ۳۰۰ کاراکتر باشد.',
            ]
        );
        $article->update($data);
        return redirect()->route('writer.article.create.step-2',['article'=>$article]);
    }
    public function createStep2(Article $article){

        $req=Required::query()->first();
        $isOrcidReq=$req->is_orcid_required;
        $writers=$article->users()
            ->orderBy('sort')
            ->get();
        return view('panel.writer.article.create-step2',[
            'article'=>$article,
            'step' => 2,
        'titles' => Title::cases(),
            'educations' => Education::cases(),
            'academicRanks' => AcademicRank::cases(),
            'educationFields' => EducationFiled::all(),
            'isOrcidReq'=>$isOrcidReq,
            'writers'=>$writers,]);
    }

    public function storeStep2(Request $request,Article $article)
    {
        $user=User::query()->where('national_code',$request['national_code'])->first();
        if ($user) {
            if (auth()->id() == $user->id){
                return back()->withErrors(['خودتان را نمیتوانید به عنوان نویسنده همکار ثبت کنید.']);
            }

        }

        if (!$user) {
            $req = Required::query()->first();
            $isReqOrcid = optional($req)->is_orcid_required ?? false;
            $data = $request->validate(
                [
                    'title' => ['required', 'integer'],
                    'name' => ['required', 'string', 'max:255', new PersianNameRule()],
                    'name_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],



                    'national_code' => ['required', 'string', 'max:20', 'unique:users,national_code',new Nationalcode()],

                    'mobile' => ['required', 'string', 'max:20','unique:users,mobile',new Cellphone()],



                    'city' => ['required', 'string', 'max:255', new PersianNameRule()],
                    'city_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],

                    'organ' => ['required', 'string', 'max:255', new PersianNameRule()],
                    'organ_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],


                    'education' => ['required', 'integer'],


                    'academic_rank' => ['required', 'integer'],


                    'orcid' =>[
                        Rule::when($isReqOrcid, ['required'], ['nullable']),
                        'string',
                        'max:20',
                        'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
                    ],

                ],[
                    // 🔹 required
                    'title.required' => 'انتخاب عنوان الزامی است.',
                    'name.required' => 'وارد کردن نام و نام خانوادگی الزامی است.',
                    'name_en.required' => 'وارد کردن نام انگلیسی الزامی است.',
                    'email.required' => 'وارد کردن ایمیل الزامی است.',

                    'national_code.required' => 'وارد کردن کد ملی الزامی است.',
                    'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
                    'city.required' => 'وارد کردن نام شهر الزامی است.',
                    'city_en.required' => 'وارد کردن نام انگلیسی شهر الزامی است.',
                    'organ.required' => 'وارد کردن نام سازمان الزامی است.',
                    'organ_en.required' => 'وارد کردن نام انگلیسی سازمان الزامی است.',
                    'education.required' => 'انتخاب مقطع تحصیلی الزامی است.',
                    'education_filed_id.required' => 'انتخاب رشته تحصیلی الزامی است.',
                    'academic_rank.required' => 'انتخاب مرتبه علمی الزامی است.',


                    // 🔹 unique
                    'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
                    'user_name.unique' => 'این نام کاربری قبلاً استفاده شده است.',
                    'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
                    'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',

                    // 🔹 format / type
                    'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',


                    // 🔹 string / integer
                    'title.integer' => 'مقدار عنوان معتبر نیست.',
                    'education.integer' => 'مقدار مقطع تحصیلی معتبر نیست.',
                    'academic_rank.integer' => 'مقدار مرتبه علمی معتبر نیست.',

                    // 🔹 max
                    'name.max' => 'نام و نام خانوادگی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
                    'name_en.max' => 'نام انگلیسی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
                    'email.max' => 'ایمیل نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
                    'user_name.max' => 'نام کاربری نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
                    'mobile.max' => 'شماره موبایل نمی‌تواند بیشتر از ۲۰ کاراکتر باشد.',

                    'orcid.max' => 'کد ORCID نمی‌تواند بیشتر از ۲۰ کاراکتر باشد.',

                    // 🔹 exists
                    'education_filed_id.exists' => 'رشته تحصیلی انتخاب‌شده معتبر نیست.',

                    // 🔹 regex
                    'orcid.regex' => 'فرمت ORCID صحیح نیست. (مثال: 0000-0000-0000-0000)',

                ]
            );
            $user=User::query()->create($data);
        }

        $lastSort = $article->users()
            ->orderByDesc('sort')
            ->value('sort');
        $article->users()->attach($user->id,[
            'sort'=>$lastSort + 1
        ]);
        return back()->with('success', 'نویسنده همکار افزوده شد.');
    }
    public function updateWriterSort(Article $article, User $user, Request $request)
    {
        $direction = $request->input('direction'); // 'up' or 'down'

        // گرفتن sort فعلی این نویسنده
        $currentSort = $article->users()
            ->wherePivot('user_id', $user->id)
            ->first()->pivot->sort;

        // نویسنده اصلی (sort=1) تغییر نمی‌کند
        if ($currentSort == 1) {
            return back();
        }

        if ($direction === 'up') {
            // پیدا کردن نویسنده با sort یک کمتر (که sort != 1 باشد)
            $targetUser = $article->users()
                ->wherePivot('sort', $currentSort - 1)
                ->wherePivot('sort', '!=', 1)
                ->first();

            if ($targetUser) {
                // جابجایی
                $article->users()->updateExistingPivot($user->id, ['sort' => $currentSort - 1]);
                $article->users()->updateExistingPivot($targetUser->id, ['sort' => $currentSort]);
            }

        } elseif ($direction === 'down') {
            $targetUser = $article->users()
                ->wherePivot('sort', $currentSort + 1)
                ->first();

            if ($targetUser) {
                $article->users()->updateExistingPivot($user->id, ['sort' => $currentSort + 1]);
                $article->users()->updateExistingPivot($targetUser->id, ['sort' => $currentSort]);
            }
        }

        return back()->with('success', 'ترتیب نویسنده‌ها به‌روزرسانی شد.');
    }
    public function deleteWriterArticle(Article $article, User $user)
    {
        if ($user->id == $article->user_id){
             return back()
                 ->withErrors(['نویسنده اصلی را نمیتوانید حذف کنید.']);
        }
        $deletedSort = $article->users()
            ->wherePivot('user_id', $user->id)
            ->first()->pivot->sort;

        $article->users()->detach($user);

        if (!$user->is_verified) {
            $user->delete();
        }

        // مرتب‌سازی مجدد sort نویسنده‌هایی که sort بزرگتر از حذف‌شده دارند
        $article->users()
            ->wherePivot('sort', '>', $deletedSort)
            ->orderBy('pivot_sort')
            ->get()
            ->each(function ($writer) use ($article) {
                $article->users()->updateExistingPivot($writer->id, [
                    'sort' => $writer->pivot->sort - 1,
                ]);
            });

        return back()->with('success', 'نویسنده همکار حذف شد.');
    }
    public function createStep3(Article $article)
    {
        if ($article->step < 3) {
            $article->update(['step' => 3]);
        }
        return view('panel.writer.article.create-step3',['step' =>3,'article'=>$article]);
    }

}
