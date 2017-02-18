<?php

namespace App\Http\Requests\Glosarium;

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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category'    => 'required|integer|exists:glosarium_categories,id',
            'origin'      => 'required|min:2',
            'locale'      => 'required|min:2',
            'description' => 'max:1000',
        ];
    }
}
