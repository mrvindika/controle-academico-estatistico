<?php

namespace App\Rules;

use App\Traits\AppendTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Phone implements ValidationRule
{
    use AppendTrait;
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Angola pattern
        $pattern= '/^(\+?244)?9\d{8}$/';
        if(!preg_match($pattern, $this->phone($value))){
            $fail('Telemovel não  válido em Angola.');
        }
    }
}
