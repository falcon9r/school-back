<?php

namespace App\Http\Requests\API\Admin\Teacher;

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
            'lesson_ids' => 'array|required',
            'lesson_ids.*' => 'integer|required|exists:lessons,id'
        ];
    }
}
