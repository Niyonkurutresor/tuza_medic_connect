<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return Patient::$rules;
    }

    public function messages(): array
    {
        return [
            'patient_unique_id.regex' => __('messages.common.space_not_allowed_in_unique_id_field'),
            'profile.max' => __('messages.profile_size'),
        ];
    }
}
