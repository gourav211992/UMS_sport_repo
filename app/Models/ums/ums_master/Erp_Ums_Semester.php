<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Erp_Ums_Semester extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'erp_ums_semester';

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'semester_code',
        'semester_name',
        'enrollment_no',
        'seq_no',
        'status',
    ];
}
