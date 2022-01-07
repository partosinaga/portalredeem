<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';

    protected $fillable = [
         'name',
         'email',
         'account_type',
         'client_id',
         'phone'
    ];
}
