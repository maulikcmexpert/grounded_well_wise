<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubAdminUpdateRequestPost extends FormRequest
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

            'first_name' =>  ['required'],
            'last_name' =>  ['required'],
            'email' => ['required',  Rule::unique('users')->where(function ($query) {
                $query->where('role_id', 1);
            })->ignore(decrypt($request->id))],
        ];
    }
}
