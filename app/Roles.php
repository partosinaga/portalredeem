<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'md_roles';
    protected $primaryKey = 'roles_id';

    protected $fillable = [
        'roles_title',
        'created_at',
        'updated_at',
        'created_by'
    ];
}
