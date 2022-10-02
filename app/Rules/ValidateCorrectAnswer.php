<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidateCorrectAnswer implements InvokableRule
{
    private mixed $type;

    public function __construct($type = null)
    {
        $this->type = $type;
    }
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!in_array(true, $value) && (int)$this->type !== 3) {
            $fail('Need at least pick 1 correct answer');
        }
    }
}
