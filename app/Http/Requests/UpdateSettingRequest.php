<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        if ($this->request->get('sectionName') == 'contact-information') {
            return [
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'address_one' => 'required',
                'address_two' => 'required',
                'postal_code' => 'required',
            ];
        }

        if ($this->request->get('sectionName') == 'general') {
            return [
                'email' => 'required|email:filter',
                'specialities' => 'required',
                'clinic_name' => 'required',
                'contact_no' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg',
                'favicon' => 'image|mimes:png|dimensions:width=32,height=32',
                'language' => 'required',
            ];
        }
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'country_id.required' => __('messages.country_required'),
            'state_id.required' => __('messages.state_required'),
            'city_id.required' => __('messages.city_required'),
            'address_one.required' => __('messages.address_1_required'),
            'address_two.required' => __('messages.address_2_required'),
            'logo.dimensions' => __('messages.logo_size'),
            'favicon.dimensions' => __('messages.favicon_size'),
        ];
    }
}
