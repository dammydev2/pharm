<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['rec', 'cprice', 'sprice', 'amount', 'balance', 'seller', 'name', 'nhis', 'nhis_no'];
}
