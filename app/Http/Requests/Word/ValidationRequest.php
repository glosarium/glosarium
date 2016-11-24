<?php

namespace App\Http\Requests\Word;

use App\Glosarium\WordCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(WordCategory $category)
    {
        $rules = [
            'category' => [
                'required',
                Rule::exists($category->getTable(), 'id'),
            ],
            'foreign'  => 'required|string',
            'locale'   => 'required|string',
            'spell'    => 'string',
        ];

        return $rules;
    }
}
