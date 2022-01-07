<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'md_regional';
    protected $primaryKey = 'region_id';

    protected $fillable = [
        "parameters_id",
        "region_title",
        "parent_region_id",
    ];
}
