<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class AddSubjectRequest extends FormRequest
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
            'name' => 'required|max:255|unique:subjects,name,user_id,'.Auth::user()->id,
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Musisz podać nazwę przedmiotu.',
            'name.unique'=>'Podany przedmiot już jest w bazie.'
        ];
    }
}
