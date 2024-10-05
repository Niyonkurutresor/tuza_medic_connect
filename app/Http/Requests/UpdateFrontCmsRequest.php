<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFrontCmsRequest extends FormRequest
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
        return [
            'about_image_1' => 'mimes:jpg,jpeg,png',
            'about_image_2' => 'mimes:jpg,jpeg,png',
            'about_image_3' => 'mimes:jpg,jpeg,png',
            'about_title' => 'required',
            'about_experience' => 'required|numeric',
            'about_short_description' => 'required',
            'terms_conditions' => 'required',
            'privacy_policy' => 'required',
        ];
    }
}
