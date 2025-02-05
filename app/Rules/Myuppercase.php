<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Myuppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value != ucfirst(strtoupper($value) != $value)) {
            $fail(':attribute must be in all caps.');
        }
    }
}
