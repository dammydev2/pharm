<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyStock extends Model
{
    protected $fillable = [
        'name',
        'current_stock',
        'cost_price',
        'selling_price',
    ];
}
