<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'required|string',
            'roll_number' => 'required|exists:students,roll_number',
            'cgpa' => 'required',
            'department_id' => 'required|numeric',
            'session_id' => 'required|numeric',
            'semester' => 'required|numeric'
        ];
    }
}
