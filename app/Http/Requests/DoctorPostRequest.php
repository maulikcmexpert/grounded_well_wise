<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorPostRequest extends FormRequest
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
            'avatar' => ['required'],
            'first_name' =>  ['required'],
            'last_name' =>  ['required'],
            'email' => ['required',  Rule::unique('users')->where(function ($query) {
                $query->whereIn('role_id', [3, 4]);
            })],
            'identity_number' => ['required', 'unique:users'],
            'gender' => ['required'],
            'profession' => ['required'],
            'contact_number' => ['required', 'numeric'],
            'password' => ['required']
        ];
    }
}
