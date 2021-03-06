<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storestock extends Model
{
    protected $fillable = ['name', 'cprice', 'currently_at_hand', 'quantity', 'selling_price', 'exp', 'autenticate', 'pack', 'batch_no', 'supplier_name', 'type'];

    public function store()
    {
        return $this->hasOne(Store::class, 'name', 'name');
    }
}
