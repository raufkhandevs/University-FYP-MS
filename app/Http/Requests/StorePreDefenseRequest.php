<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreDefenseRequest extends FormRequest
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
            'defense_type_id' => 'required|exists:defenses,defense_type_id',
            'project_id' => 'required|exists:defenses,project_id',
            'panel_id' => 'required|exists:defenses,panel_id',
        ];
    }
}
