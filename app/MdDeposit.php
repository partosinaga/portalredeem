<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdDeposit extends Model
{
    protected $table = 'md_client_deposit';
    protected $primaryKey = 'deposit_id';
    protected $fillable = [
        'client_id',
		'deposit_payment_date',
		'deposit_document_number',
		'deposit_receipt_number',
		'deposit_amount',
		'desposit_description',
		'deposit_document_url',
		'deposit_status',
		'created_by'
    ];
}
