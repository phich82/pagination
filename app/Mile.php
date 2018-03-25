<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mile extends Model
{
    use SoftDeletes;

    protected $table = 'mile_basic_settings';

    protected $fillable = [
        'plan_start_date',
        'amount'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
