<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quota extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'quotas';

    protected $dates = ['deleted_at'];

    use HasFactory;
    protected $fillable = ['quota_name', 'discount','display_name','status'];
    
}
