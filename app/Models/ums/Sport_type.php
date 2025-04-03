<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport_type extends Model
{
    use HasFactory;
    protected $table = 'sports_type';
    protected $fillable = ['type'];
}
