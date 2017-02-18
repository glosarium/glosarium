<?php

namespace App\Http\Requests\User\Glosarium;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() and Auth()->user()->type == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id'    => 'required|integer|exists:glosarium_categories,id',
            'text'  => 'required|string',
            'field' => 'required',
        ];

        return $rules;
    }
}
