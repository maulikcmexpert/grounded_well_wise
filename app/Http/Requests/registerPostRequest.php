<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registerPostRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'passport_SAID' => 'required|in:passport,SA_ID',
            'identity_number' => 'required|unique:users',
            'date_of_birth' => 'required',
            'language' => 'required',
            // 'referring_provider' => 'required|unique:patient_details',
            // 'next_of_kin' => 'required',
            // 'name' => 'required',
            // 'surname' => 'required',
            // 'contact_number' => 'numeric',
            // 'alternative_contact_number' => 'numeric',
            // 'physical_address' => 'required',
            // 'complex_name' => 'required',
            // 'unit_no' => 'required',
            // 'city' => 'required|',
            // 'country' => 'required',
            // 'postal_code' => 'numeric',
            // 'EZMed_number' => 'unique:patient_details',
            // 'gender' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));
    }
}
