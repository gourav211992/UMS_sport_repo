<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportQuota extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'sport_quotas';

    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $fillable = ['quota_name', 'discount','display_name','status','organization_id',
        'group_id',
        'company_id'];
    
}
