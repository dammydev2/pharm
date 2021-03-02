<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = ['name', 'folio_no', 'cprice', 'sprice', 'markup', 'type'];
}
