<?php

namespace App\Http\Requests;

use App\Rules\minWords;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ContactRequest extends FormRequest
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
            "ends_with" => ":attribute Must ends with : :values ",
        ];
    }

    #[Override]
    public function attributes()
    {
        return [
            "name" => "Name",
            "email" => "Email",
            "subject" => "Subject",
            "message" => "Message",
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
            "name" => ["required", "max:255"],
            "email" => ["required", "email", "ends_with:gmail.com,hotmail.com"],
            "subject" => ["required", "max:120"],
            "message" => ["required", new minWords(5)],

        ];
    }
}
