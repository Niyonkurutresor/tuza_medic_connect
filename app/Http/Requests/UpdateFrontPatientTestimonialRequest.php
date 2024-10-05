<?php

namespace App\Http\Requests;

use App\Models\FrontPatientTestimonial;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFrontPatientTestimonialRequest extends FormRequest
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
        $rules = FrontPatientTestimonial::$editRules;

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'profile.max' => __('messages.profile_size'),
        ];
    }
}
