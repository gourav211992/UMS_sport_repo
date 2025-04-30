<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportTrainingDetail extends Model
{
    use HasFactory;

    protected $table = 'sport_training_details';

    protected $fillable = [
        'registration_id',
        'previous_coach',
        'training_academy',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}
