<?php

namespace App\Models\ums\Activity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sport_Rating_Scale extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'sport_rating_scales';
    protected $fillable = [
        'scores',
        'remarks',
        'status'
    ];
    
}