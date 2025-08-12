<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCurrency extends Model
{
    protected $fillable = [
        'currency_name',
        'value',
        'description'
    ];
}
