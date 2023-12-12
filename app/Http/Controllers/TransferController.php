<?php

namespace App\Http\Controllers;

use App\Http\Requests\transfer\TransferFormRequest;
use App\Jobs\TransferJob;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Carbon\Carbon;

class TransferController extends Controller
{
    public function index(Request $request) {
        $wallets = auth()->user()
                            ->wallets
                            ->map(function ($item, $key) {
                                return $item ->only(['id', 'balance']);
                            });
        return view('transfer.index', compact('wallets'));
    }

    public function store(TransferFormRequest $request) {

        $data = $request->validated();

        $wallet_in = Wallet::where('user_id', $data['ajax_select_get_users'])
                            ->first()
                            ->value('id');
        $transfer_start_datetime = date('Y-m-d H:i', strtotime($data['datetime_transfer']));
        $transfer = Transfer::create([
            'wallet_id_out' => $data['select_wallets'],
            'wallet_id_in' => $wallet_in,
            'transfer_amount' => $data['balance'],
            'transfer_start_datetime' => $transfer_start_datetime
        ]);

        if (Carbon::now() > $transfer_start_datetime) {
            TransferJob::dispatch($transfer);
        }

        return back();
        

    }
}
