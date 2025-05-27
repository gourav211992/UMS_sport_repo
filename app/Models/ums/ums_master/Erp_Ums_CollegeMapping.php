<?php
namespace App\Models\ums\ums_master;
use App\Models\ums\ums_master\Erp_Ums_InstituteMapping;
use App\Models\ums\ums_master\CourseModel;
use App\Models\ums\ums_master\ProgramTypeModel;
use App\Models\ums\ums_master\Program_Types;
use App\Models\ums\ums_master\Program_branches;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Erp_Ums_CollegeMapping extends Model
{
    use HasFactory;

    protected $table = 'erp_ums_collage_mapping';

    protected $fillable = [
        'id',
        'organization_id',
        'group_id',
        'company_id',
        'institute_id',
        'program_type_id',
        'course_id',
        'program_branch_ids', 
        'status'
    ];

    public function institute()
    {
        return $this->belongsTo(Erp_Ums_InstituteMapping::class, 'institute_id');
    }

    public function courses()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }

    public function program_type()
    {
        return $this->belongsTo(ProgramTypeModel::class, 'program_type_id');
    }

    // Handle JSON field for program_branch_ids
    public function getProgramBranchAttribute()
    {
        return json_decode($this->program_branch_ids, true);
    }


}

