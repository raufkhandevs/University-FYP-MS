<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFypRegistrationNumberRequest extends FormRequest
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
            'personal_email' => 'required|unique:users,email',
            'gender' => 'required',
            'agreement' => 'required',
            'passed_subjects' => 'required|numeric',
            'phone' => 'required|unique:users,phone',
            'current_residential' => 'required',
            'permanent_address' => 'nullable'
        ];
    }
}
