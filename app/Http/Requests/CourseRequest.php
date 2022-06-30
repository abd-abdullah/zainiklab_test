<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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

        if ($this->route()->getName() != 'assign_student') {
            $courseId = $this->course->id ?? NULL;
            return [
                'name' => ['bail', 'required', 'string', 'max:191'],
                'code' => ['bail', 'required', 'string', 'max:191', 'unique:users,email,' . $courseId],
                'thumbnail' => ['bail', ($courseId ? 'nullable' : 'required'), 'mimes:jpg,jpeg,png,gif,webp', 'max:300'],
                'price' => ['bail', 'required', 'min:1'],
            ];
        }
        else{
            return [
                'student_id.0' => 'required',
            ];
        }
    }
}
