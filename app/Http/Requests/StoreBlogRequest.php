<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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

            "title" => ["required"],
            "sub_title" => ["required"],
            "subject" => ["required"],
            "image" => ["required", "image", "mimes:jpg,jpeg,png,webp", "max:5000"],
            "content" => ["required"],
            "tags" => ["sometimes", "array"],
            "tags.*" => ["exists:tags,id"],


        ];
    }
}
