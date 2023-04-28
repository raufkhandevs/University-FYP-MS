<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
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
            'submission_type_id' => 'required|exists:submission_types,id',
            'project_id' => 'required|exists:projects,id',
            'deadline_status' => 'nullable',
            'file' => 'required',
        ];
    }
}
