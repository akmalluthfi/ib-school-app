<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class UniqueRelation implements InvokableRule
{
    public function __construct(
        private $relationModel,
    ) {
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
        $data = $this->relationModel->firstWhere($attribute, $value);

        if ($data !== null) {
            $fail('The :attribute must be unique.');
        }
    }
}
