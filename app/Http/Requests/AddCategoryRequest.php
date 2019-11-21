<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AddCategoryRequest extends FormRequest
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
        return [
            'name' => 'required|max:255|unique:categories,name,user_id,' . Auth::user()->id,
            'subject_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Musisz podać nazwę kategorii.',
            'name.unique'=>'Podana kategoria już jest w bazie.'
        ];
    }
}
