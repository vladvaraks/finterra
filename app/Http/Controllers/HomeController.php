<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(Request $request) {
        $data = DB::select('select users.name user_out, transfer.name user_in, transfer.transfer_amount, transfer.transfer_start_datetime, transfer.flag_transfer
                            from users
                            left join (select w1.user_id, u.name, t.transfer_amount, t.transfer_start_datetime, t.flag_transfer
                            from transfers t
                            inner join wallets w1
                            on  w1.id = t.wallet_id_out
                            inner join wallets w2
                            on  w2.id = t.wallet_id_in
                            inner join users u
                            on w2.user_id = u.id
                            where t.id in (select max(t.id)
                            from transfers t
                            join wallets w1
                            on t.wallet_id_out = w1.id
                            group by w1.user_id
                            having max(t.transfer_start_datetime))) transfer
                            on users.id=transfer.user_id
                            order by user_out;');//->paginate(10, ['*'], 'page', $request->page);
        $data = $this->paginate($data);
        return view('home.index', compact('data'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
