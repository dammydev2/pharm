<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name','folio_no', 'cprice', 'reorder', 'type', 'selling_price', 'markup'];
}
