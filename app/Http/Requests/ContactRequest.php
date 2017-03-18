<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
        ];

        if (!Auth::check()) {
            $rules['email'] = 'required|email|max:100';
        }

        return $rules;
    }
}
