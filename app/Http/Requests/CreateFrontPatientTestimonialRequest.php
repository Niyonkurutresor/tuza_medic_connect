<?php

namespace App\Http\Requests;

use App\Models\FrontPatientTestimonial;
use Illuminate\Foundation\Http\FormRequest;

class CreateFrontPatientTestimonialRequest extends FormRequest
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
        return FrontPatientTestimonial::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'profile.max' => __('messages.admin_dashboard'),
        ];
    }
}
