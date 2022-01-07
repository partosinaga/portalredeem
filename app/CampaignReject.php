<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignReject extends Model
{
    protected $table = 'bsn_campaign_reject';
    protected $primaryKey = 'campaign_reject_id';

    protected $fillable = [
       'campaign_reject_reason',
       'campaign_id',
       'created_at',
       'updated_at',
       'created_by',
    ];
}
