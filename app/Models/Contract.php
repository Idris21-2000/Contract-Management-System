<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'contract_id',
        'counterpart_name',
        'counsel_comment',
        'attach_file_path',
        'contract_type_id',
        'assignees_id',
        'period_of_contract',
        'signing_date',
        'renewal_date',
        'cost',
        'payment_mode_id',
        'payment_type_id',
        'implementation_mode',
        'status'
    ];

    //Eloquent relationships
    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignees_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
}
