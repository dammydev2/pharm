<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storestock extends Model
{
    protected $fillable = ['name', 'cprice', 'quantity', 'selling_price', 'exp', 'autenticate', 'pack', 'batch_no', 'supplier_name', 'type'];
}
