<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class minWords implements ValidationRule
{


    public function __construct(public $words) {}
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (str_word_count($value) < $this->words) {
           $fail("The $attribute Field Must Be $this->words Words Or More");
        }
    }
}
