<?php

namespace App\Http\Requests;

use App\Rules\minWords;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
        return [

            "type" => ["required", "in:course_support,instructor_application"],
            "major" => ["required"],

            "job_title" => ["required"],
            "phone" => ["required", "numeric", "min_digits:10"],

            "portfolio_link" => ["required", "url"],

            "description" => ["required", new minWords(20)],
            "personal_image" => ["nullable", "image", "mimes:png,jpg", "max:6000"],
            "CV" => ['required',"mimes:pdf", "max:10000"]
        ];
    }
}
