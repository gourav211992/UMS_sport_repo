<?php

namespace App\Models\ums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportRegistrationDetail extends Model
{
    use HasFactory;

    protected $table = 'sport_registration_details';

    protected $fillable = [
        'registration_id',
        'badminton_experience',
        'highest_achievement',
        'level_of_play',
        'medical_conditions',
        'current_medications',
        'dietary_restrictions',
        'blood_group',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}
