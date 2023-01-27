<?php

namespace App\Http\Requests\API\Grade;

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
            'teacher_id' => 'required|exists:teachers,id',
            'number' => 'integer|between:0,12|required',
            'sign' => 'string|required',
            'created' => 'date|nullable'
        ];
    }
}
