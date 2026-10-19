<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $course_id=$this->route("course");
        return [
            'title'           => ['required', 'string', 'max:255',Rule::unique("courses","title")->ignore($course_id)],
            'sub_title'       => ['nullable', 'string', 'max:255'],
            'instructor_id'   => ['required', 'exists:instructors,id'], // التأكد أن رقم المدرب موجود في جدول instructors
            'type'            => ['required', 'in:online,recorded'],
            'price'           => ['required', 'numeric', 'min:0'],
            'duration'        => ['nullable', 'string', 'max:100'],
            'total_lectures'  => ['nullable', 'integer', 'min:1'],
            'date'            => ['required_if:type,online', "after:+1 week"],
            'available_seats' => ['nullable', 'integer', 'min:1'],
            'certification'   => ['required', 'in:yes,no'],
            'overview'        => ['nullable', 'string'],
            'description'     => ['nullable', 'string'],
            'curriculum'      => ['nullable', 'string'],
            'outer_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4048'], // بحد أقصى 2 ميجابايت
            'inner_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4048'],
        ];
    }
}
