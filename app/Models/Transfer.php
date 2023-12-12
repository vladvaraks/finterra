<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfers';
    protected $fillable = ['wallet_id_out', 'wallet_id_in', 'transfer_amount','transfer_start_datetime', 'flag_transfer'];

}
