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

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user=auth()->user();
        $req = Required::query()->first();
        $isReqOrcid = optional($req)->is_orcid_required ?? false;

        return [
            'title' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255', new PersianNameRule()],
            'name_en' => ['required', 'string', 'max:255',new EnglishNameWithSymbolRule()],

            'email_help' => ['nullable', 'email', 'max:300'],


            'national_code' => ['required', 'string', 'max:20', 'unique:users,national_code,' . $user->id,new Nationalcode()],

            'mobile' => ['required', 'string', 'max:20','unique:users,mobile,' . $user->id,new Cellphone()],
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
                'nullable',
                'string',
                'max:20',
                'regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
            ],





            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_card' => ['nullable', 'string', 'max:20'],
            'bank_account' => ['nullable', 'string', 'max:30'],

            'user_description' => ['nullable', 'string'],

            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است.',
            'name.required' => 'نام فارسی الزامی است.',
            'name.max' => 'نام فارسی نباید بیش از ۲۵۵ کاراکتر باشد.',
            'name_en.required' => 'نام انگلیسی الزامی است.',
            'name_en.max' => 'نام انگلیسی نباید بیش از ۲۵۵ کاراکتر باشد.',



            'email_help.email' => 'فرمت ایمیل کمکی معتبر نیست.',
            'email_help.max' => 'ایمیل کمکی نباید بیش از ۳۰۰ کاراکتر باشد.',


            'national_code.required' => 'کد ملی الزامی است.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
            'national_code.max' => 'کد ملی نباید بیش از ۲۰ کاراکتر باشد.',

            'mobile.required' => 'شماره موبایل الزامی است.',

            'fax.max' => 'فکس نباید بیش از ۳۰ کاراکتر باشد.',
            'phone.max' => 'شماره تلفن نباید بیش از ۲۰ کاراکتر باشد.',

            'city.required' => 'نام شهر الزامی است.',
            'city.max' => 'نام شهر نباید بیش از ۲۵۵ کاراکتر باشد.',
            'city_en.required' => 'نام شهر انگلیسی الزامی است.',
            'city_en.max' => 'نام شهر انگلیسی نباید بیش از ۲۵۵ کاراکتر باشد.',

            'organ.required' => 'نام سازمان الزامی است.',
            'organ.max' => 'نام سازمان نباید بیش از ۲۵۵ کاراکتر باشد.',
            'organ_en.required' => 'نام سازمان انگلیسی الزامی است.',
            'organ_en.max' => 'نام سازمان انگلیسی نباید بیش از ۲۵۵ کاراکتر باشد.',

            'postal_code.max' => 'کد پستی نباید بیش از ۱۵ کاراکتر باشد.',
            'url.url' => 'آدرس وب‌سایت معتبر نیست.',
            'url.max' => 'آدرس وب‌سایت نباید بیش از ۲۵۵ کاراکتر باشد.',

            'education.required' => 'تحصیلات الزامی است.',
            'education_filed_id.required' => 'رشته تحصیلی الزامی است.',
            'education_filed_id.exists' => 'رشته تحصیلی انتخاب شده معتبر نیست.',

            'academic_rank.required' => 'مرتبه علمی الزامی است.',
            'research_favorite.required' => 'زمینه تحقیقاتی الزامی است.',
            'research_favorite.max' => 'زمینه تحقیقاتی نباید بیش از ۳۰۰ کاراکتر باشد.',

            'orcid.required' => 'شناسه ORCID الزامی است.',
            'orcid.regex' => 'فرمت ORCID معتبر نیست (مثال: 0000-0000-0000-0000).',

            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',

            'bank_card.max' => 'شماره کارت بانکی نباید بیش از ۲۰ کاراکتر باشد.',
            'bank_account.max' => 'شماره حساب بانکی نباید بیش از ۳۰ کاراکتر باشد.',
        ];
    }
}
