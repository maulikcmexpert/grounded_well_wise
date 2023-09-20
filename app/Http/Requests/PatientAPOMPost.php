<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientAPOMPost extends FormRequest
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
            // "attention" => ['required', 'min:1', 'max:18', 'numeric'],
            // "nonVerbalEyeContact" => ['required', 'min:1', 'max:18', 'numeric'],
            // "verbalContent" => ['required', 'min:1', 'max:18', 'numeric'],
            // "relationsSocialNorms" => ['required', 'min:1', 'max:18', 'numeric'],
            // "relationsRapport" => ['required', 'min:1', 'max:18', 'numeric'],
            // "personalCare" => ['required', 'min:1', 'max:18', 'numeric'],
            // "assertiveness" => ['required', 'min:1', 'max:18', 'numeric'],
            // "stressManagement" => ['required', 'min:1', 'max:18', 'numeric'],
            // "conflictManagement" => ['required', 'min:1', 'max:18', 'numeric'],
            // "problemSolvingSkills" => ['required', 'min:1', 'max:18', 'numeric'],
            // "roleBalance" => ['required', 'min:1', 'max:18', 'numeric'],
            // "timeUseRoutines" => ['required', 'min:1', 'max:18', 'numeric'],
            // "habits" => ['required', 'min:1', 'max:18', 'numeric'],
            // "mixOfOccupations" => ['required', 'min:1', 'max:18', 'numeric'],
            // "showsInterest" => ['required', 'min:1', 'max:18', 'numeric'],
            // "locusOfControl" => ['required', 'min:1', 'max:18', 'numeric'],
            // "selfWorth" => ['required', 'min:1', 'max:18', 'numeric'],
            // "attitudeSelfAssurance" => ['required', 'min:1', 'max:18', 'numeric'],
            // "attitudeSelfSatisfaction" => ['required', 'min:1', 'max:18', 'numeric'],
            // "awarenessOfQualities" => ['required', 'min:1', 'max:18', 'numeric'],
            // "repertoireOfEmotions" => ['required', 'min:1', 'max:18', 'numeric'],
            // "emotionControl" => ['required', 'min:1', 'max:18', 'numeric'],
            // "moods" => ['required', 'min:1', 'max:18', 'numeric'],
        ];
    }
}
