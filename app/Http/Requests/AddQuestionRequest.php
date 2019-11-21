<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AddQuestionRequest extends FormRequest
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
            
            'subject_id' => 'required',
            'category_id' => 'required',
            'group_of_students' => 'required',
            'points' => 'required|numeric',
            'question_content' => 'required|unique:questions,user_id,'.Auth::user()->id,
        ];
    }

    public function messages()
    {
        return [
            
            'question_content.required'=>'Musisz podać treść pytania.',
            'question_content.unique'=>'Podane pytanie już jest w bazie.',
            'points.numeric' => 'Punkty muszą być liczbą.',
            'points.required' => 'Musisz podać liczbę punktów za to pytanie.',
            'category_id.required' => 'Wybierz kategorię pytania.'
        ];
    }
}
