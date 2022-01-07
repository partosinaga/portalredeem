<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartCustomer extends Model
{
    protected $table = 'bsn_customer_cart';
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'campaign_recipient_id',
        'voucher_catalog_id',
        'voucher_catalog_main_image_url',
        'voucher_catalog_title',
        'valid_end_date',
        'voucher_catalog_value_amount',
        'qty',
        'created_at',
        'updated_at',
        'created_by',
    ];
}
