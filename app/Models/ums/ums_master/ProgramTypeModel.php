<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramTypeModel extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'erp_ums_program_type';

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'program_code',
        'program_name',
        'enrollment_no',
        'seq_no',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function course()
    // {
    //     return $this->belongsTo(CourseModel::class, 'course_id');
    // }
    public function programBranches()
    {
        return $this->hasMany(Program_branches::class, 'program_type_id');
    }

    public function courses()
{
    return $this->hasMany(CourseModel::class, 'program_type', 'id');
}

    protected $dates = ['deleted_at']; 

}
