<?php

namespace App\Models\ums\Activity;

use App\Models\ums\GroupMaster;
use App\Models\ums\batch;
use App\Models\ums\Section;
use App\Models\ums\Sport_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityScheduler extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $dates = ['deleted_at'];
    protected $table = 'activity_scheduler';
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
    return $this->belongsTo(Section::class, 'section'); // foreign key column ka naam 'section' hai
}

public function groupRelation()
{
    return $this->belongsTo(GroupMaster::class, 'group'); // foreign key column ka naam 'group' hai
}
public function batchRelation()
{
    return $this->belongsTo(batch::class, 'batch_name'); // Assuming batch_name = batch_id
}

public function sportRelation()
{
    return $this->belongsTo(Sport_master::class, 'sport');
}



}
