<?php

namespace App\Jobs;

use App\Models\Wallet;
use App\Models\Transfer;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $transfer;
    /**
     * Create a new job instance.
     */
    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            Wallet::where('id', $this->transfer->wallet_id_out)
                                ->decrement('balance',  $this->transfer->transfer_amount);
            if (Wallet::find($this->transfer->wallet_id_out)->balance < 0) {
                throw new Exception('Баланс ушел в минус.');
            }
            Wallet::where('id',  $this->transfer->wallet_id_in)
                    ->increment('balance',  $this->transfer->transfer_amount);
            Transfer::where('id',  $this->transfer->id)
                    ->update(['flag_transfer' => True]);
        });
    }
}
