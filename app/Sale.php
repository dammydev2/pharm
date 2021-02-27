<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['stockid', 'name', 'sprice', 'cprice', 'quantity', 'identity', 'rec'];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'rec');
    }

    public function drug()
    {
        return $this->hasOne(Drug::class, 'name', 'name');
    }
}
