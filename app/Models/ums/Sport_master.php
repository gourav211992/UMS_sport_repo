<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport_master extends Model
{
    use HasFactory;
    protected $table = 'sports_master';
    protected $fillable = [
        'sport_type', // example of a field, replace with actual fields of your table
        'sport_name', // example of a field, replace with actual fields of your table
        'status',     // example of a field, replace with actual fields of your table
    ];

}
