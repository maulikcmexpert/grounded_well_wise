<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RasPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'questions.*.answer' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'questions.*.answer.required' => 'Please select an answer for each question.',

        ];
    }
}
