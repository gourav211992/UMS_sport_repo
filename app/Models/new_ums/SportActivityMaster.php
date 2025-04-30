<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SportActivityMaster extends Model
{
    use HasFactory;
    use SoftDeletes;  // Enable soft deletes

    protected $dates = ['deleted_at'];
    protected $table = 'sport_activity_master';

    protected $fillable = [
        'sport_id',          // Foreign key to the sports_master table
        'activity_name',

        'sub_activities',
        'activity_duration_min',      // Corrected to match your column name (was 'Duration(min)')
        'description',
        'status',
        'organization_id',
        'group_id',
        'company_id',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport_master::class, 'sport_id');
    }
}
