<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program_Types extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'erp_ums_program_type';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'program_code',
        'program_name',
        'enrollment_no',
        'seq_no',
        'description',
        'status',
    ];

    public function programBranches()
    {
        return $this->hasMany(Program_branches::class, 'program_type_id');
    }
}
