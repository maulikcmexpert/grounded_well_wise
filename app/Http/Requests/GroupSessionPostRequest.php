<?php

namespace App\Http\Requests;

use Flasher\Laravel\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupSessionPostRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'group_id' => ['required'],
            'session_name' => [
                'required',

                'session_name' => Rule::unique('group_sessions')->where(fn ($query) => $query->where('group_id', $request->group_id)),

            ],
            'session_details' => ['required']
        ];
    }
}
