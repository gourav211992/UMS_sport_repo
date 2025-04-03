<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batch extends Model
{
    use HasFactory;
    public $table='batches';
    protected $fillable=['batch_name','batch_year','status'];
    protected $guarded=[];

}
