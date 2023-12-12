<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletsController extends Controller
{
    public function index(Request $request) {
        $wallets = auth()->user()
                        ->wallets()
                        ->selectRaw('wallets.id, wallets.balance, ifnull(SUM(transfers.transfer_amount), 0) as sum_amount')
                        ->leftJoin('transfers', function ($join) {
                            $join->on('wallets.id', '=', 'transfers.wallet_id_out')
                                ->where('transfers.flag_transfer', 0);
                        })
                        ->groupBy('wallets.id', 'wallets.balance')
                        ->get();
        return view('wallets.index', compact('wallets'));
    }

    public function store() {
        $user = auth()->user();
        $count_wallets = auth()->user()->wallets->count();
        if ($count_wallets > 2) {
            return back()->withErrors(['count_wallets_error' => 'Вы не можете иметь более 3 кошельков']);
        }
        else{
            Wallet::create([
                'user_id' => $user->id
            ]);
            return redirect()->back();
        }
    }

    public function edit(Wallet $wallet) {
        return view('wallets.edit', compact('wallet'));
    }

    public function update(Wallet $wallet) {
        $data = request()->validate([
            'balance' => ['required', 'numeric', 'min:10']
        ]);
        
        $result = $data['balance']+$wallet->balance;

        $wallet->update([
            'balance' => $result
        ]);

        return redirect()->route('wallets');
    }
}