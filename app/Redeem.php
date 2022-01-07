<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table = 'log_voucher_redeemtion';
    protected $primaryKey = 'log_redeemtion_id';
    protected $fillable = [
        "campaign_transaction_id",
        "voucher_code",
        "redeem_status",
        "redeem_status_description",
        "voucher_outlets_id",
        "created_at",
        "updated_at",
        "created_by"
    ];
}
