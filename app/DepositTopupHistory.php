<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositTopupHistory extends Model
{
    protected $table = 'client_topup_history';
    protected $primaryKey = 'id';
    protected $fillable = [
		"client_id",
		"trx_id",
		"amount",
		"deposit_amount_before",
		"deposit_amount_after"
	];
}
