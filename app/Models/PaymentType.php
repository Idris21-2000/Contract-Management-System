<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'type_name'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'payment_type_id');
    }
}
