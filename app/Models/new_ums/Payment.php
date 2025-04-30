<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DefaultGroupCompanyOrg;
use App\Traits\Deletable;
class Payment extends Model
{
    use Deletable,DefaultGroupCompanyOrg;


    protected $fillable = [
        'bank_name',
        'pay_mode',
        'ref_no',
        'pay_doc',
        'paid_amount',
        'user_id',
        'remarks',
        'pay_confirmation_date',
        'pay_confirmation_time',
        'pay_collector'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}