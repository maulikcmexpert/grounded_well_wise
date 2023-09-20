<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientsPostRequest extends FormRequest
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
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required'],
            'passport_SAID' => ['required', 'in:passport,SA_ID'],
            'password' => ['required'],
            'identity_number' => ['required', 'unique:users'],
            'date_of_birth' => ['required'],
            // 'language' => ['required'],
            // 'referring_provider' => ['required'],
            // 'EZMed_number' => ['required', 'unique:patient_details'],
            // 'gender' => ['required'],
            // 'next_of_kin' => ['required'],
            // 'name' => ['required'],
            // 'surname' => ['required'],
            // 'contact_number' => ['required', 'numeric'],
            // 'alternative_contact_number' => ['required', 'numeric'],
            // 'physical_address' => ['required'],
            // 'complex_name' => ['required'],
            // 'unit_no' => ['required'],
            // 'city' => ['required'],
            // 'country' => ['required'],
            // 'postal_code' => ['required', 'numeric'],
        ];
    }
}
