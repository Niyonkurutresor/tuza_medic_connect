<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        $rules = Role::$rules;
        $rules['display_name'] = 'required|unique:roles,display_name,'.$this->route('role')->id;

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'display_name.required' => __('messages.common.name_required'),
            'display_name.unique' => __('messages.common.name_already_taken'),
            'permission_id.required' => __('messages.common.any_one_permission'),
        ];
    }
}
