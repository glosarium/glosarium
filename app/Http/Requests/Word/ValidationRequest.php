<?php

namespace App\Http\Requests\Word;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        $rules = [
            'origin'    => 'required|string',
            'glosarium' => 'required|string',
            'spell'     => 'required|string',
        ];

        return $rules;
    }
}
