<?php

namespace App\Http\Requests\API\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'login' => 'unique:students,login|required',
            'password' => 'string|min:4|max:16|required',
            'first_name' => 'string|nullable',
            'grade_id' => 'required|exists:grades,id',
            'last_name' => 'nullable|string',
            'patronymic' => 'string|nullable',
            'telefon' => 'nullable|string|min:7'
        ];
    }
}
