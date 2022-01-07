<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'bsn_campaign';
    protected $primaryKey = 'campaign_id';
    protected $fillable = [
        "campaign_title",
        "client_id",
        "campaign_start_date",
        "campaign_end_date",
        "campaign_status",
        "campaign_message_title",
        "campaign_message",
        "campaign_bg_color",
        "campaign_font_color",
        "created_at",
        "updated_at",
        "created_by"
    ];
}
