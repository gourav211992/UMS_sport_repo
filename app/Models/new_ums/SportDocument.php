<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportDocument extends Model
{
    use HasFactory;

    protected $table = 'sport_document'; 

    protected $fillable = [
        'registration_id',
        'id_proof',
        'aadhar_card',
        'parent_aadhar',
        'birth_certificate',
        'medical_record',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}
