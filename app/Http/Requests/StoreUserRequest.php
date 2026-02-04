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
                'nullable',
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
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'user_name.unique' => 'این نام کاربری قبلاً استفاده شده است.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
            'education_filed_id.exists' => 'رشته تحصیلی انتخاب شده معتبر نیست.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
        ];
    }
}
