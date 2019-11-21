<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAnswersRequest extends FormRequest
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
            'answer1' => 'required|max:255',
            'answer2' => 'required|max:255',
            'answer3' => 'max:255',
            'answer4' => 'max:255',
            'answer5' => 'max:255',
            'answer6' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'answer1.required'=>'Musisz podać treść odpowiedzi nr 1.',
            'answer2.required'=>'Musisz podać treść odpowiedzi nr 2.',
        ];
    }
}
