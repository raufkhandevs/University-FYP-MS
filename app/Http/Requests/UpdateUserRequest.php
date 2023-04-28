<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'phone' => 'nullable',
            'gender' => 'nullable',
            'avatar' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'role_id' => 'required',
            'department_id' => 'required',
            'designation' => 'required',
        ];
    }
}
