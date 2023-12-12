<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Wallet;

class ActiveWallet implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $check_wallet = Wallet::where('user_id', $value)->exists();
        if ($check_wallet == False) {
            $fail('У данного пользователя нет активных счетов.');
        }
    }
}
