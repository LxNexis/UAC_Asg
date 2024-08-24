<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckBox implements ValidationRule
{
    protected $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_array($value) && count($value) < $this->min) {
            $fail("You must select at least {$this->min} checkboxes.");
        }
    }
}
