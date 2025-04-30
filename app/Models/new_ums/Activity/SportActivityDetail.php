<?php

namespace App\Models\ums\activity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportActivityDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduler_id',
        'date',
        'students',

    ];
}
