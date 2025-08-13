<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    protected $fillable = [
        'mode_name',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'payment_mode_id');
    }
}
