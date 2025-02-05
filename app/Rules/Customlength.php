<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Customlength implements ValidationRule

{
    protected $min;
    protected $max;
    public function __construct($min = 5, $max = 255)
    {
        $this->min = $min;
        $this->max = $max;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $length = strlen($value);
        if ($length < $this->min) {
            $fail("The $attribute must be at least {$this->min} characters. Yours is $length.");
        }
        if ($length > $this->max) {
            $fail("The $attribute must not exceed {$this->max} characters. Yours is $length.");
        }
    }
}
