<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storestock extends Model
{
    protected $fillable = ['name', 'cprice', 'quantity', 'exp', 'autenticate', 'pack'];
}
