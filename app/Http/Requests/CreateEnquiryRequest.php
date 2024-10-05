<?php

namespace App\Http\Requests;

use App\Models\Enquiry;
use Illuminate\Foundation\Http\FormRequest;

class CreateEnquiryRequest extends FormRequest
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
        return Enquiry::$rules;
    }

        /**
     * Get the validation rules that apply to the request.
     */
    public function messages(): array
    {
        app()->setLocale(checkLanguageSession());
        return [
            'name.required'=> __('messages.common.name_required'),
            'email.required'=> __('messages.common.email_required'),
            'message.required'=> __('messages.common.message_required'),
            'subject.required'=> __('messages.common.subject_required'),
            'email.max' => __('messages.common.email_max'),
            'email.regex' => __('messages.common.email_regex'),
        ];
    }
}
