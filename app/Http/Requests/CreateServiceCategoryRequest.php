<?php

namespace App\Http\Requests;

use App\Models\ServiceCategory;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceCategoryRequest extends FormRequest
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
        return ServiceCategory::$rules;
    }
}
