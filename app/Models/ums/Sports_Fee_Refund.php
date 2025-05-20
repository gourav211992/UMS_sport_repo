<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SportRegister;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sports_Fee_Refund extends Model
{
    use HasFactory;
    protected $table='sports_fee_refunds';
    use SoftDeletes;
    protected $fillable = [
        'id',
        'organization_id',
        'group_id',
        'company_id',
        'registration_id',
        'registration_number',
        'total_fee_paid',
        'total_discount',
        'total_refunded',
        'refund_breakdown',
        'refund_method',
        'batch_id',
        'section_id',
        'transaction_number',
        'refund_date',
        'reason',
        'approved_by'
    ];
    public function sportRegister()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id', 'id');
    }

    public function batch()
{
    return $this->belongsTo(SportBatch::class, 'batch_id', 'id');
}

public function section()
{
    return $this->belongsTo(SportSection::class, 'section_id', 'id');
}

}
