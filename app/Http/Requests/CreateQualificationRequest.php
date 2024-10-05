<?php

namespace App\Http\Requests;

use App\Models\Qualification;
use Illuminate\Foundation\Http\FormRequest;

class CreateQualificationRequest extends FormRequest
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
        return Qualification::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'degree.required' => __('messages.flash.degree_required'),
            'university.required' => __('messages.flash.university_required'),
            'year.required' => __('messages.flash.year_required'),
        ];
    }
}
