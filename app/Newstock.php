<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newstock extends Model
{
    protected $fillable = ['stockid', 'name', 'sprice', 'cprice', 'quantity', 'exp', 'identity'];
}
