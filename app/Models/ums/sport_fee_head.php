<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class sport_fee_head extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $table = 'sport_fee_head'; 
     protected $fillable = [
        'fee_head',
        'status',
    ];

    protected $dates = ['deleted_at'];
    
}
