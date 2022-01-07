<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    protected $table = 'trx_client_history_deposit';
    protected $primaryKey = 'history_deposit_id';
    protected $fillable = [
        "campaign_id",
		"amount",
		"cretated_by"
    ];
}
