<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class CreateServicesRequest extends FormRequest
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
        return Service::$rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'category_id.required' => __('messages.common.category_required'),
        ];
    }
}
