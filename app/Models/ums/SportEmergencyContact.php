<?php
namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportEmergencyContact extends Model
{
    use HasFactory;

    protected $table = 'sport_emergency_contacts';

    protected $fillable = [
        'registration_id',
        'name',
        'relation',
        'contact_no',
        'email',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}
