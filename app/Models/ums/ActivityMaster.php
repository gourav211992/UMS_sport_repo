<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ActivityMaster extends Model
{
    use HasFactory;
    use SoftDeletes;  // Enable soft deletes

    protected $dates = ['deleted_at'];
    protected $table = 'activity_master';

    protected $fillable = [
        'sport_id',          // Foreign key to the sports_master table
        'activity_name',
       
        'sub_activities',
        'activity_duration_min',      // Corrected to match your column name (was 'Duration(min)')
        'description',
        'status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport_master::class, 'sport_id');
    }
}
