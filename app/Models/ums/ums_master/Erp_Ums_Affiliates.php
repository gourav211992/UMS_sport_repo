<?php

namespace App\Models\ums\ums_master;

use App\Models\Country;  // Import the Country model from App\Models
use App\Models\State;    // Import the State model from App\Models
use App\Models\City;     // Import the City model from App\Models
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Erp_Ums_Affiliates extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'erp_ums_affiliate'; // Table name
    protected $fillable = [
        'type',
        'affiliate_code',
        'affiliate_name',
        'head_office',
        'address',
        'country_id', // Assuming this is the country ID
        'state_id',   // Assuming this is the state ID
        'city_id',    // Assuming this is the city ID
        'pincode',
        'contact_person',
        'email_id',
        'mobile',
        'phone',
        'status',
    ];

    // Relationship with Country (Assuming 'country' is the foreign key for the country ID)
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id'); // 'country' is the foreign key
    }

    // Relationship with State (Assuming 'state' is the foreign key for the state ID)
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); // 'state' is the foreign key
    }

    // Relationship with City (Assuming 'city' is the foreign key for the city ID)
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id'); // 'city' is the foreign key
    }
}
