<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxGiftVouchers extends Model
{
    protected $table = 'trx_gift_voucher';
    protected $primaryKey = 'id';
    protected $fillable = [
        'voucher_code',
		'voucher_id',
		'sender_id',
		'method',
		'recipient',
		'status'
    ];
}
