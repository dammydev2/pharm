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

    public function store()
    {
        return $this->hasOne(Store::class, 'name', 'name');
    }
}
