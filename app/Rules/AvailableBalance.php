<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Wallet;
use Illuminate\Contracts\Validation\DataAwareRule;

class AvailableBalance implements DataAwareRule, ValidationRule
{
    protected $data = [];

    /**
    * Set the data under validation.
    *
    * @param  array<string, mixed>  $data
    */
   public function setData(array $data): static
   {
       $this->data = $data;

       return $this;
   }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (array_key_exists('select_wallets', $this->data)){
            $balance_for_transfer = Wallet::selectRaw('wallets.balance - ifnull(SUM(transfers.transfer_amount), 0) as balance')
                                                        ->leftJoin('transfers', function ($join) {
                                                            $join->on('wallets.id', '=', 'transfers.wallet_id_out')
                                                                ->where('transfers.flag_transfer', 0);
                                                        }) 
                                                        ->where('wallets.id', $this->data['select_wallets'])
                                                        ->groupBy('wallets.id', 'wallets.balance')
                                                        ->value('balance');
            if  ($balance_for_transfer < $value) {
                $fail("Сумма перевода не должна превышать $balance_for_transfer");
            }
        }
        
        #if  ($balance_for_transfer < $value) {
        #    $fail("Сумма перевода не должна превышать $balance_for_transfer");
        #}
    }
}
