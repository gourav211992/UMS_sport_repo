<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Erp_Ums_InstituteMapping extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'erp_ums_institute';

    protected $fillable = [
        'type',
        'affiliate_id',
        'institute_name',
        'enroll_no_code',
        'status',
        'organization_id',
        'group_id',
        'company_id'
    ];

    public function affiliate()
    {
        return $this->belongsTo( Erp_Ums_Affiliates::class, 'affiliate_id');
    }
}
