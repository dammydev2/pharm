<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'name',
        'currently_at_hand',
        'folio_no',
        'cost_price',
        'at_hand',
        'auditor',
    ];
}
