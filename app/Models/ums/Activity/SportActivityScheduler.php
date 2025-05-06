<?php

namespace App\Models\ums\activity;

use App\Models\MasterGroup;
use App\Models\ums\Activity\Employee;
use App\Models\ums\SportBatch;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\SportSection;
use App\Models\ums\Sport_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportActivityScheduler extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $dates = ['deleted_at'];
    protected $table = 'sport_activity_scheduler';
    public $timestamps = false;

    protected $fillable = [
        'sport',        
        'batch_year',
        'batch_name',
        'section',
        'group',
        'trainer',
        'activity',
        'sub_activities',
        'start_date',      
        'end_date',      
        'day',      
        'start_time',      
        'end_time',      
        'remarks',
        'status',
        'batch_student',
        'scheduler_no',
    ];

    public function sectionRelation()
{
    return $this->belongsTo(SportSection::class, 'section'); // foreign key column ka naam 'section' hai
}

public function groupRelation()
{
    return $this->belongsTo(SportGroupMaster::class, 'group'); // foreign key column ka naam 'group' hai
}
public function batchRelation()
{
    return $this->belongsTo(SportBatch::class, 'batch_name'); // Assuming batch_name = batch_id
}

public function sportRelation()
{
    return $this->belongsTo(Sport_master::class, 'sport');
}

public function trainerRelation()
{
    return $this->belongsTo(Employee::class, 'trainer');
}


}
