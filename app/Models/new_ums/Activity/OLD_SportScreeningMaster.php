<?php

namespace App\Models\ums\Activity;

use App\Models\ums\Sport_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportScreeningMaster extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sport_screening_masters';
    



    public function screen(){
        return $this->belongsTo(Sport_master::class, 'sport_id', 'id');
    }

    
    protected $dates = ['deleted_at'];



}
