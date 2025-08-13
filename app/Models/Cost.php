<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'amount',
        'country_currency',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'cost_id');
    }
}
