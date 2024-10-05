<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaytmDetailRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:filter',
            'mobile' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'mobile.required' => __('messages.payment_method.mobile_required'),
        ];
    }
}
