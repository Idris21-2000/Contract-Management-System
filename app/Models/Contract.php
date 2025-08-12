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
        'cost_id',
        'payment_mode_id',
        'payment_type_id',
        'implementation_mode',
        'status'
    ];
}
