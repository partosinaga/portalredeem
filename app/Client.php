<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'md_client';
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_id',
        'client_title',
        'client_legal_title',
        'client_user_in_charge',
        'client_industry',
        'client_employee_size',
        'client_image_logo',
        'client_tax_no',
        'client_billing_address_line_1',
        'client_billing_address_line_2',
        'client_province',
        'client_city',
        'client_area',
        'client_postal_code',
        'client_bank_title',
        'client_bank_branch',
        'client_bank_account_number',
        'client_bank_account_name',
        'client_allow_postpaid',
        'client_outstanding_limit',
        'created_at',
        'updated_at',
        'created_by'
    ];
}
