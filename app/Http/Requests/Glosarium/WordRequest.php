<?php
namespace App\Http\Requests\Glosarium;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'category_id' => [
                'required',
                'string',
                Rule::exists( (new \App\Glosarium\Category)->getTable(), 'slug')
            ],
            'origin' => 'required|min:2|max:255',
            'locale' => 'required|min:2|max:255',
            'description' => 'max:1000',
            'source' => 'string|max:255'
        ];
    }
}
