<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PatientsPostUpdateRequest extends FormRequest
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
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required'],
            'passport_SAID' => ['required', 'in:passport,SA_ID'],
            'identity_number' => ['required',   Rule::unique('users')->ignore(decrypt($request->id))],
            'date_of_birth' => ['required'],
            //'language' => ['required'],
            'referring_provider' => ['required'],
            'EZMed_number' => ['required', Rule::unique('patient_details')->ignore($request->detail_id)],
            // 'gender' => ['required'],
            // 'next_of_kin' => ['required'],
            // 'name' => ['required'],
            // 'surname' => ['required'],
            // 'contact_number' => ['required', 'numeric'],
            // 'alternative_contact_number' => ['required', 'numeric'],
            // 'physical_address' => ['required'],
            // 'complex_name' => ['required'],
            // 'unit_no' => ['required', 'numeric'],
            // 'city' => ['required'],
            // 'country' => ['required'],
            // 'postal_code' => ['required', 'numeric'],
        ];
    }
}
