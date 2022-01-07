<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'md_industry';
    protected $primaryKey = 'industry_id';

    protected $fillable = [
        "industry_id",
        "industry_title",
        "created_at",
        "updated_at",
        "created_by"
    ];
}
