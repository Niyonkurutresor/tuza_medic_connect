<?php

namespace App\Http\Requests;

use App\Models\Visit;
use Illuminate\Foundation\Http\FormRequest;

class CreateVisitRequest extends FormRequest
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
        return Visit::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'patient_id.required' => __('messages.visit.PatientRequired'),
            'doctor_id.required' => __('messages.visit.DoctorRequired'),
        ];
    }
}
