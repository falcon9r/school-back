<?php

namespace App\Http\Requests\API\Admin\GradeStudent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'students_ids' => 'required|array',
            'students_ids.*' => 'integer|exists:students,id'
        ];
    }
}
