<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPpobQueue extends Model
{
    protected $table = 'trx_ppob_queue';
    protected $primaryKey = 'redeem_id';
    protected $fillable = [
        'voucher_code',
		'account_number',
		'trx_type',
		'service_code',
		'amount',
		'package_code',
		'trx_id_request',
		'status',
		'ppob_username',
		'ppob_password',
		'time_request'
    ];
}
