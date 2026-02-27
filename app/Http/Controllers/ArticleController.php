<?php

namespace App\Http\Controllers;

use App\Enums\AcademicRank;
use App\Enums\Education;
use App\Enums\Title;
use App\Models\Article;
use App\Models\EducationFiled;
use App\Models\Keyword;
use App\Models\Required;
use App\Models\User;
use App\Rules\Cellphone;
use App\Rules\EnglishNameWithSymbolRule;
use App\Rules\Nationalcode;
use App\Rules\PersianNameRule;
use App\Rules\PhoneRule;
use App\Rules\UserNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        do {
            $code ='rep-'. strtolower(Str::random(6));
        } while (Article::where('code', $code)->exists());
        $article->update([
            'step'=>2,
            'user_id'=>auth()->id(),
            'code'=>$code
        ]);
        $article->users()->attach(auth()->id(), [
            'sort' => 1,
            'is_confirm' => 1
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
    public function storeStep3(Request $request, Article $article)
    {
         $data=$request->validate([
            'summary'=>[
                'required',
                'max:5000',
                'string',

            ],
            'summary_en'=>[
                'required',
                'max:5000',
                new englishNameWithSymbolRule(),
            ],
        ],[
            'summary.required' => 'چکیده فارسی مقاله الزامی است.',
            'summary.string' => 'چکیده فارسی باید به صورت متن باشد.',
            'summary.max' => 'چکیده فارسی مقاله بیش از حد مجاز طولانی است.',

            'summary_en.required' => 'چکیده انگلیسی مقاله الزامی است.',
            'summary_en.max' => 'چکیده انگلیسی مقاله بیش از حد مجاز طولانی است.',
        ]);

         $article->update($data);
        if ($article->step < 4) {
            $article->update(['step' => 4]);
        }
        return redirect()->route('writer.article.create.step-4',['article'=>$article]);
    }
    public function createStep4(Article $article)
    {

        $article->load('keywords');

        return view('panel.writer.article.create-step4', [
            'step'    => 4,
            'article' => $article,
        ]);
    }

    public function storeStep4(Request $request, Article $article)
    {

        $data = $request->validate([
            'keywords'             => 'required|array|min:1',
            'keywords.*.title'     => ['required','string','max:100',new PersianNameRule()],
            'keywords.*.title_en'  =>  ['required','string','max:100',new EnglishNameWithSymbolRule()],
        ], [
            'keywords.required'    => 'وارد کردن حداقل یک کلمه کلیدی الزامی است.',
            'keywords.array'       => 'کلمات کلیدی باید به صورت آرایه ارسال شوند.',
            'keywords.min'         => 'حداقل یک کلمه کلیدی وارد کنید.',

            'keywords.*.title.required'    => 'عنوان فارسی کلمه کلیدی الزامی است.',
            'keywords.*.title.max'         => 'عنوان فارسی نباید بیشتر از ۱۰۰ کاراکتر باشد.',

            'keywords.*.title_en.required' => 'عنوان انگلیسی کلمه کلیدی الزامی است.',
            'keywords.*.title_en.max'      => 'عنوان انگلیسی نباید بیشتر از ۱۰۰ کاراکتر باشد.',
        ]);

        // پردازش و sync کلمات کلیدی
        $keywordIds = $this->processKeywords($data['keywords']);
        $article->keywords()->sync($keywordIds);

        // بروزرسانی step
        if ($article->step < 5) {
            $article->update(['step' => 5]);
        }

        return redirect()->route('writer.article.create.step-5', ['article' => $article]);
    }

    private function processKeywords(array $keywords): array
    {
        $ids = [];

        foreach ($keywords as $kw) {
            $title    = trim($kw['title'] ?? '');
            $titleEn  = strtolower(trim($kw['title_en'] ?? ''));

            // اگر هر دو خالی بود رد کن
            if (empty($title) && empty($titleEn)) {
                continue;
            }

            // جستجو بر اساس هر کدام که پر است
            $keyword = Keyword::where('title', $title)
                ->orWhere('title_en', $titleEn)
                ->first();

            if (!$keyword) {
                $keyword = Keyword::create([
                    'title'    => $title ?: null,
                    'title_en' => $titleEn ?: null,
                ]);
            }

            $ids[] = $keyword->id;
        }

        return array_unique($ids);
    }
    public function createStep5(Article $article)
    {

        return view('panel.writer.article.create-step5',['step' =>5,'article'=>$article]);
    }
    public function storeStep5(Request $request, Article $article)
    {

        $data = $request->validate([
            'juror_offer_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'juror_offer_id' => [
                'nullable',
                'integer',
                'min:1',
                'exists:users,id'
            ],
            'juror_offer_mobile' => [
                'nullable',
                'string',
                'max:20',
                new Cellphone()
            ],
            'juror_offer_email' => [
                'nullable',
                'email',
                'max:255'
            ],
        ], [
            'juror_offer_name.string' => 'نام داور پیشنهادی باید به صورت متن وارد شود.',
            'juror_offer_name.max' => 'نام داور پیشنهادی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'juror_offer_id.integer' => 'شناسه داور پیشنهادی نامعتبر است.',
            'juror_offer_id.min' => 'شناسه داور پیشنهادی نامعتبر است.',
            'juror_offer_id.exists' => 'داور انتخاب‌شده در سیستم وجود ندارد.',

            'juror_offer_mobile.string' => 'شماره موبایل داور پیشنهادی باید به صورت متن وارد شود.',
            'juror_offer_mobile.max' => 'شماره موبایل داور پیشنهادی نمی‌تواند بیشتر از ۲۰ کاراکتر باشد.',

            'juror_offer_email.email' => 'ایمیل داور پیشنهادی معتبر نیست.',
            'juror_offer_email.max' => 'ایمیل داور پیشنهادی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ]);

         if ($request->filled('juror_offer_name') ||$request->filled('juror_offer_mobile')||$request->filled('juror_offer_email')){
             if (!$request['juror_offer_name'] ||!$request['juror_offer_mobile']||!$request['juror_offer_email']){
                 return back()->withErrors(['لطفا در صورت وارد کردن نام داور پیشنهادی تمام موارد نظیر موبایل و ایمیل داور پیشنهادی را وارد کنید.']);
             }
         }

         if (!$request['juror_offer_id']) {
             $data['juror_offer_id']=null;
         }
            $article->update($data);



        if ($article->step < 6) {
            $article->update(['step' => 6]);
        }
        return redirect()->route('writer.article.create.step-6',['article'=>$article]);
    }
    public function createStep6(Article $article)
    {

        return view('panel.writer.article.create-step6',['step' =>6,'article'=>$article]);
    }
    public function storeStep6(Request $request, Article $article)
    {
        $data = $request->validate([
            'ai_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'ai_description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ], [
            'ai_name.string' => 'نام هوش مصنوعی باید به صورت متن وارد شود.',
            'ai_name.max' => 'نام هوش مصنوعی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'ai_description.string' => 'توضیحات هوش مصنوعی باید به صورت متن وارد شود.',
            'ai_description.max' => 'توضیحات هوش مصنوعی نمی‌تواند بیشتر از ۵۰۰۰ کاراکتر باشد.',
        ]);
        if ($request->filled('ai_name') ||$request->filled('ai_description')){
            if (!$request['ai_description'] ||!$request['ai_description']){
                return back()->withErrors(['لطفا در صورت استفاده از هوش مصنوعی تمام فیلد ها را وارد کنید.']);
            }
        }

        $article->update($data);
        if ($article->step < 7) {
            $article->update(['step' => 7]);
        }
        return redirect()->route('writer.article.create.step-7',['article'=>$article]);
    }
    public function createStep7(Article $article)
    {

        return view('panel.writer.article.create-step7',['step' =>7,'article'=>$article]);
    }
    public function storeStep7(Request $request, Article $article)
    {

        $data = $request->validate([
            'file_primary' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],
            'file_secondary' => [
                'nullable',
                'file',
                'max:10240',
            ],

        ], [
            // فایل اصلی (PDF)

            'file_primary.file' => 'فایل اصلی  pdf باید یک فایل معتبر باشد.',
            'file_primary.mimes' => 'فایل pdf باید با فرمت PDF باشد.',
            'file_primary.max' => 'حجم فایل اصلی  pdf نباید بیشتر از ۱۰ مگابایت باشد.',

            // فایل ثانویه (Word)

            'file_secondary.file' => 'فایل word باید یک فایل معتبر باشد.',

            'file_secondary.max' => 'حجم فایل word نباید بیشتر از ۱۰ مگابایت باشد.',
        ]);

        if(!$article->file_primary && !$request->hasFile('file_primary') ){
            return back()->withErrors(['فایل pdf  برای مقاله یافت نشد لطفا  فایل را اپلود کنید.']);
        }
        if( !$article->file_secondary && !$request->hasFile('file_secondary')){
            return back()->withErrors(['فایل word برای مقاله یافت نشد لطفا  فایل را اپلود کنید.']);
        }
        $code=$article->code;

        if ($request->hasFile('file_primary')) {
            if ($article->file_primary) {
                Storage::disk('public')->delete('articles-pdf/' . $article->file_primary);
            }
            $filePrimaryExtension = $data['file_primary']->getClientOriginalExtension();
            $filePrimaryName = $code . "." . $filePrimaryExtension;
            $request->file_primary->storeAs('articles-pdf', $filePrimaryName, 'public');
            $article->update([
                'file_primary' => $filePrimaryName,
            ]);
        }


        if ($request->hasFile('file_secondary')){
            $extension = strtolower($request->file('file_secondary')->getClientOriginalExtension());
            if (!in_array($extension, ['doc', 'docx'])) {
                return back()->withErrors(['file_secondary' => 'فایل word باید با فرمت doc یا docx باشد.']);
            }
            if ($article->file_secondary) {
                Storage::disk('public')->delete('articles-word/' . $article->file_secondary);
            }
            $fileSecondaryExtension = $data['file_secondary']->getClientOriginalExtension();
            $fileSecondaryName = $code . "." . $fileSecondaryExtension;
            $request->file_secondary->storeAs('articles-word', $fileSecondaryName, 'public');
            $article->update([
                'file_secondary' => $fileSecondaryName,
            ]);
        }






        if ($article->step < 8) {
            $article->update(['step' => 8]);
        }
        return redirect()->route('writer.article.create.step-8',['article'=>$article]);
    }
    public function articlePdfDownload(Article $article)
    {
        return Storage::disk('public')->download('articles-pdf/' . $article->file_primary);
    }
    public function articleWordDownload(Article $article)
    {
        return Storage::disk('public')->download('articles-word/' . $article->file_secondary);
    }
    public function createStep8(Article $article)
    {

        return view('panel.writer.article.create-step8',['step' =>8,'article'=>$article]);
    }
}
