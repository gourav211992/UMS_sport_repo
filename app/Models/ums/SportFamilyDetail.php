<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportFamilyDetail extends Model
{
    use HasFactory;

    protected $table = 'sport_family_details';

    protected $fillable = [
        'registration_id',
        'relation',
        'name',
        'contact_no',
        'email',
        'permanent_street1',
        'permanent_street2',
        'permanent_town',
        'permanent_district',
        'permanent_state',
        'permanent_country',
        'permanent_pincode',
        'correspondence_street1',
        'correspondence_street2',
        'correspondence_town',
        'correspondence_district',
        'correspondence_state',
        'correspondence_country',
        'correspondence_pincode',
        'is_guardian',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class, 'registration_id');
    }
}
