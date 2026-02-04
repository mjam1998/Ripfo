<?php

namespace App\Http\Requests;

use App\Rules\EnglishNameWithSymbolRule;
use App\Rules\PersianNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'title'=>[
               'required',
               'max:300',
               new PersianNameRule(),
           ],
            'title_en'=>[
                'required',
                'max:300',
                new EnglishNameWithSymbolRule(),
            ],
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
            'juror_offer_name'=>[
                'nullable',
                'string',
                'max:255',
            ],
            'file_primary'=>[
                'required',
                'file',
                'mimes:pdf',
                'max:10240'
            ],
            'file_secondary'=>[
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240'
            ],
            'keywords_id' => [
                'required',
                'array',
                'min:1',
            ],
            'keywords_id.*' => [
                'required',
                'integer',
                'exists:keywords,id',
            ],

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان فارسی مقاله الزامی است.',
            'title.max' => 'عنوان فارسی مقاله نباید بیشتر از ۳۰۰ کاراکتر باشد.',

            'title_en.required' => 'عنوان انگلیسی مقاله الزامی است.',
            'title_en.max' => 'عنوان انگلیسی مقاله نباید بیشتر از ۳۰۰ کاراکتر باشد.',

            'summary.required' => 'چکیده فارسی مقاله الزامی است.',
            'summary.string' => 'چکیده فارسی باید به صورت متن باشد.',
            'summary.max' => 'چکیده فارسی مقاله بیش از حد مجاز طولانی است.',

            'summary_en.required' => 'چکیده انگلیسی مقاله الزامی است.',
            'summary_en.max' => 'چکیده انگلیسی مقاله بیش از حد مجاز طولانی است.',

            'juror_offer_name.string' => 'نام داور پیشنهادی باید به صورت متن باشد.',
            'juror_offer_name.max' => 'نام داور پیشنهادی نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'file_primary.required' => 'فایل اصلی مقاله الزامی است.',
            'file_primary.file' => 'فایل اصلی مقاله معتبر نیست.',
            'file_primary.mimes' => 'فایل اصلی مقاله باید با فرمت PDF باشد.',
            'file_primary.max' => 'حجم فایل اصلی مقاله نباید بیشتر از ۱۰ مگابایت باشد.',

            'file_secondary.file' => 'فایل پیوست مقاله  معتبر نیست.',
            'file_secondary.mimes' => 'فایل پیوست مقاله باید با فرمت PDF باشد.',
            'file_secondary.max' => 'حجم فایل پیوست مقاله نباید بیشتر از ۱۰ مگابایت باشد.',

            'keywords_id.required' => 'انتخاب حداقل یک کلمه کلیدی الزامی است.',
            'keywords_id.array' => 'فرمت کلمات کلیدی نامعتبر است.',
            'keywords_id.min' => 'حداقل باید یک کلمه کلیدی انتخاب شود.',

            'keywords_id.*.integer' => 'کلمه کلیدی انتخاب شده نامعتبر است.',
            'keywords_id.*.exists' => 'کلمه کلیدی انتخاب شده وجود ندارد.',

        ];
    }

}
