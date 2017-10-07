<?php

namespace App\Http\Requests\User;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
        \Validator::extend('password', function ($attribute, $value) {
            return \Hash::check($value, Auth::user()->password);
        });

        return [
            'current_password' => 'required|password',
            'password'         => 'required|min:6|confirmed',
        ];
    }
}
