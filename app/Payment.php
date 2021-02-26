<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['rec', 'cprice', 'status', 'sprice', 'amount', 'type', 'balance', 'seller', 'name', 'nhis', 'nhis_no'];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'rec', 'rec');
    }

}
