<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
#[Override]
public function messages()
{
    return [


    "instructor_id.exists"=>"No Instructor With This Name "

    ];
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255',"unique:courses,title"],
            'sub_title'       => ['nullable', 'string', 'max:255'],
            'instructor_id'   => ['required', 'exists:instructors,id'], // التأكد أن رقم المدرب موجود في جدول instructors
            'type'            => ['required', 'in:online,recorded'],
            'price'           => ['required', 'numeric', 'min:0'],
            'duration'        => ['nullable', 'string', 'max:100'],
            'total_lectures'  => ['nullable', 'integer', 'min:0'],
            'date'            => ['required_if:type,online',"after:+1 week"],
            'available_seats' => ['nullable', 'integer', 'min:0'],
            'certification'   => ['required', 'in:yes,no'],
            'overview'        => ['nullable', 'string'],
            'description'     => ['nullable', 'string'],
            'curriculum'      => ['nullable', 'string'],
            'outer_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4048', "required_without:inner_image"], // بحد أقصى 2 ميجابايت
            'inner_image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4048', "required_without:outer_image"],
        ];
    }
}
