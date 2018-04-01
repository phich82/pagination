<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'activity_id', 
        'activity_title', 
        'area_pathJP',
        'activity_start_date',
        'activity_end_date',
        'purchase_start_date',
        'purchase_end_date',
        'rate_type',
        'amount',
        'created_user',
        'updated_user'
    ];
}
