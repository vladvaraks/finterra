<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WalletBelongAuthUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $check_wallet = auth()->user()->wallets()->where('id',$value)->exists();
        if ($check_wallet == False) {
            $fail('Вы не можете перевести с данного кошелька.');
        }
    }
}
