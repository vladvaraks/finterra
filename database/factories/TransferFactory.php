<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id_out' => Wallet::factory(),
            'wallet_id_in' => Wallet::factory(),
            'transfer_amount' => 50,
            'transfer_start_datetime' => now()
        ];
    }
}
