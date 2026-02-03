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
                'max:65000',
                'string',

            ],
            'summary_en'=>[
                'required',
                'max:65000',
                new englishNameWithSymbolRule(),
            ],
            'juror_offer_name'=>[
                'nullable',
                'string',
                'max:255',
            ]

        ];
    }
}
