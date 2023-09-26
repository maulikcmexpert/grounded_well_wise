<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupPostRequest extends FormRequest
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
            'group_type' => ['required'],
            'group_name' => ['required', 'unique:groups,group_name'],
            'group_details' => ['required'],
            'start_session_date' => ['required'],
            'total_session' => ['required', 'numeric']
        ];
    }
}
