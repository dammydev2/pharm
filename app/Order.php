<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'quantity', 'collector', 'cost_price', 'seller', 'collecting_unit', 'bulk', 'type'];
}
