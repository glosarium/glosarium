<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'about' => 'string|max:1000',
            'website' => 'url|max:100',
            'facebook' => 'url|max:100',
            'instagram' => 'string|max:20',
            'twitter' => 'string|max:15'
        ];
    }
}
