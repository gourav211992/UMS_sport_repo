<?php

namespace App\Models\ums\Activity;

use App\Models\ums\Sport_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportActivityMaster extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'sports_activity_master';

    protected $fillable = [
        'sport_id',          // Foreign key to the sports_master table
        'activity_name',
       
        'sub_activities',
        'duration_min',      
        'description',
        'status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport_master::class, 'sport_id');
    }
}
