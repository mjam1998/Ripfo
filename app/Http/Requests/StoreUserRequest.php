<?php

namespace App\Http\Requests;

use App\Models\Required;
use App\Rules\Cellphone;
use App\Rules\EnglishNameWithSymbolRule;
use App\Rules\Nationalcode;
use App\Rules\NumberRule;
use App\Rules\PersianNameRule;
use App\Rules\PhoneRule;
use App\Rules\UserNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class StoreUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $req = Required::query()->first();
        $isReqOrcid = optional($req)->is_orcid_required ?? false;

        return [
            'title' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255', new PersianNameRule()],
            'name_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'email_help' => ['nullable', 'email', 'max:300'],

            'user_name' => ['required', 'string', 'max:255', 'unique:users,user_name', new UserNameRule()],
            'national_code' => ['required', 'string', 'max:20', 'unique:users,national_code',new Nationalcode()],

            'mobile' => ['required', 'string', 'max:20','unique:users,mobile',new Cellphone()],
            'fax' => ['nullable', 'string', 'max:30',new PhoneRule()],
            'phone' => ['nullable', 'string', 'max:20',new PhoneRule()],

            'city' => ['required', 'string', 'max:255', new PersianNameRule()],
            'city_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],

            'organ' => ['required', 'string', 'max:255', new PersianNameRule()],
            'organ_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],

            'postal_code' => ['nullable', 'string', 'max:15'],
            'url' => ['nullable', 'url', 'max:255'],

            'education' => ['required', 'integer'],
            'education_filed_id' => ['required', 'exists:education_fileds,id'],

            'academic_rank' => ['required', 'integer'],
            'research_favorite' => ['required', 'string', 'max:300'],

            'orcid' =>[
                Rule::when($isReqOrcid, ['required'], ['nullable']),
                'string',
                'max:20',
                'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
            ],



            'is_juror_want' => ['nullable', 'boolean'],

            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_card' => ['nullable', 'string', 'max:20'],
            'bank_account' => ['nullable', 'string', 'max:30'],

            'user_description' => ['nullable', 'string'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [

            // 🔹 required
            'title.required' => 'انتخاب عنوان الزامی است.',
            'name.required' => 'وارد کردن نام و نام خانوادگی الزامی است.',
            'name_en.required' => 'وارد کردن نام انگلیسی الزامی است.',
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'user_name.required' => 'وارد کردن نام کاربری الزامی است.',
            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
            'city.required' => 'وارد کردن نام شهر الزامی است.',
            'city_en.required' => 'وارد کردن نام انگلیسی شهر الزامی است.',
            'organ.required' => 'وارد کردن نام سازمان الزامی است.',
            'organ_en.required' => 'وارد کردن نام انگلیسی سازمان الزامی است.',
            'education.required' => 'انتخاب مقطع تحصیلی الزامی است.',
            'education_filed_id.required' => 'انتخاب رشته تحصیلی الزامی است.',
            'academic_rank.required' => 'انتخاب مرتبه علمی الزامی است.',
            'research_favorite.required' => 'وارد کردن حوزه پژوهشی الزامی است.',
            'password.required' => 'وارد کردن رمز عبور الزامی است.',

            // 🔹 unique
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'user_name.unique' => 'این نام کاربری قبلاً استفاده شده است.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است.',

            // 🔹 format / type
            'email.email' => 'فرمت ایمیل وارد شده صحیح نیست.',
            'email_help.email' => 'فرمت ایمیل کمکی صحیح نیست.',
            'url.url' => 'آدرس وب‌سایت وارد شده معتبر نیست.',
            'postal_code.max' => 'کد پستی نمی‌تواند بیشتر از ۱۵ کاراکتر باشد.',

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
            'fax.max' => 'شماره فکس نمی‌تواند بیشتر از ۳۰ کاراکتر باشد.',
            'phone.max' => 'شماره تلفن نمی‌تواند بیشتر از ۲۰ کاراکتر باشد.',
            'research_favorite.max' => 'حوزه پژوهشی نمی‌تواند بیشتر از ۳۰۰ کاراکتر باشد.',
            'orcid.max' => 'کد ORCID نمی‌تواند بیشتر از ۲۰ کاراکتر باشد.',

            // 🔹 exists
            'education_filed_id.exists' => 'رشته تحصیلی انتخاب‌شده معتبر نیست.',

            // 🔹 regex
            'orcid.regex' => 'فرمت ORCID صحیح نیست. (مثال: 0000-0000-0000-0000)',

            // 🔹 boolean (checkbox)
            'is_juror_want.boolean' => 'وضعیت آمادگی برای داوری باید مشخص باشد.',

            // 🔹 password
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',
        ];
    }

}
