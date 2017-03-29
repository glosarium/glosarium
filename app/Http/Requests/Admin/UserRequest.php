<?php

namespace App\Http\Requests\Admin;

use App\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->isMethod('post')) {
            return Auth::user()->can('create', User::class);
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
            'name'   => 'required|max:50|string',
            'type'   => 'required|in:admin,contributor',
            'active' => 'required|boolean',
        ];

        return $rules;
    }
}
