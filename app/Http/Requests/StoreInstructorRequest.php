<?php

namespace App\Http\Requests;

use App\Rules\minWords;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
        // dd("Eeeeeeeeee");

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            "personal_image" => ["required", "image", "mimes:png,jpg"],

            "job_title" => ["required"],

            "portfolio_link" => ["nullable", "ends_with:.com"],
            "description" => [new minWords(10)],

            "phone" => ["numeric", "min_digits:10"],
        ];
    }
}
