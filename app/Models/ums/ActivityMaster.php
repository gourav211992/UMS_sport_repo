<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMaster extends Model
{
    use HasFactory;
    protected $table = 'activity_master';
    protected $fillable = [
        'sport_name',
        'activity_name',
        'parent_group',
        'sub_activities',
        'duration_min',
        'description',
        'status',
    ];
}
