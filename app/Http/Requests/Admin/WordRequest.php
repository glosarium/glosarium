<?php

namespace App\Http\Requests\Admin;

use App\Glosarium\Word;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->isMethod('post')) {
            return Auth::user()->can('create', Word::class);
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
            'category' => 'required|integer',
            'lang'     => 'required|string|max:3',
            'origin'   => 'required|string|max:255',
            'locale'   => 'required|string|max:255',
            'publish'  => 'required|boolean',
        ];

        return $rules;
    }
}
