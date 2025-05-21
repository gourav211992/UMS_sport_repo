<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'erp_ums_academic_year'; 

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'institute_id',
        'academic_code',
        'academic_year',
        'start_date',
        'end_date',
        'enrollment_no',
        'sequence_no',
        'status',
    ];
    public function institute()
{
    return $this->belongsTo(InstituteMapping::class, 'institute_id');
}
}

