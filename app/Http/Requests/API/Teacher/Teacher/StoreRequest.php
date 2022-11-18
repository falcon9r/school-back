<?php

namespace App\Http\Requests\API\Teacher\Teacher;

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
        $id = auth('teacher-api')->id();
        return [
            'first_name' => 'string|nullable',
            'last_name' => 'string|nullable',
            'patronymic' => 'string|nullable',
            'email' => 'nullable|unique:teachers,email,'.$id,
            'telefon' => 'nullable|unique:teachers,email,'.$id,
            'birthday' => 'date|nullable',
        ];
    }
}
