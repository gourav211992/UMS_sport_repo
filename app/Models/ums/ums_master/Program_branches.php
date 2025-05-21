<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Program_branches extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'erp_ums_program_branch';

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'program_type_id',
        'course_id',
        'program_branch_code',
        'program_branch_name',
        'enrollment_no',
        'seq_no',
        'description',
        'status',
    ];

    // Relationships
    public function programType()
    {
        return $this->belongsTo(Program_Types::class, 'program_type_id');
    }

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }
    
}
