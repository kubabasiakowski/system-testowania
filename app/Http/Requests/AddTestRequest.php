<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTestRequest extends FormRequest
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
            
            'time' => 'required|numeric',
            'number_of_questions' => 'required|numeric',
            'testPassword' => 'required|confirmed',

        ];
    }

    public function messages()
    {
        return [
            'time.required' => 'Należy podać czas trwania testu.',
            'time.numeric' => 'Należy podać liczbe minut trwania testu.',

            'number_of_questions.required' => 'Należy podać liczbe pytań.',
            'number_of_questions.numeric' => 'Liczba pytań musi być liczbą całkowitą.',

            'testPassword.required' => 'Należy podać hasło do testu.',
            'testPassword.confirmed' => 'Podane hasła się nie zgadzają.',

        ];
    }
}
