<?php

namespace App\Models\ums;
use App\Models\SportRegister;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportSponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'name',
        'spoc',
        'phone',
        'email',
        'email_position',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}