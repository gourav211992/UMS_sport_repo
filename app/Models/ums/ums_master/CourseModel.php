<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseModel extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'erp_ums_course';

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'program_id',
        'program_type',
        'course_code',
        'course_name',
        'enrollment_no',
        'sequence_no',
        'description',
        'status',
    ];

    public function programType()
{
    return $this->belongsTo(ProgramTypeModel::class, 'program_id');
}

    protected $dates = ['deleted_at']; 

}
