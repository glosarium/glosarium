<?php

namespace App\Http\Requests\Admin\Bot;

use App\Bot\Keyword;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class KeywordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->isMethod('post')) {
            return Auth::user()->can('create', Keyword::class);
        }

        return Auth::check() and Auth::user()->type == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'message'     => 'required|max:500',
            'description' => 'required|max:500',
        ];

        if (request()->isMethod('post')) {
            $rules['keyword'] = 'required|string|max:50|unique:bot_keywords,keyword';
        }

        return $rules;
    }
}
