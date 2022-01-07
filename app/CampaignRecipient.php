<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CampaignRecipient extends Authenticatable
{
    protected $table = 'bsn_campaign_recipient';
    protected $primaryKey = 'campaign_recipient_id';

    protected $fillable = [
        'campaign_id',
        'campaign_recipient_name',
        'campaign_recipient_credential',
        'campaign_recipient_balance',
        'campaign_recipient_current_balance',
        'created_at',
        'updated_at',
        'created_by',
    ];

}
