<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $studentId = $this->student->id ?? NULL;
        return [
            'first_name' => ['bail', 'required', 'string', 'max:191'],
            'last_name' => ['bail', 'required', 'string', 'max:191'],
            'photo' => ['bail', ($studentId ? 'nullable' : 'required'), 'mimes:jpg,jpeg,png,gif,webp', 'max:300'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255','unique:users,email,' . $studentId],
            'registration_no' => ['bail', 'required', 'string', 'unique:users,registration_no,' . $studentId,],
            'password' => ['bail', 'nullable', 'string', 'min:8'],
        ];
    }
}
