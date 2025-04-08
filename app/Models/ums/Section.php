<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'batch' ,'year', 'status'];

    protected $guarded=[];

    public function groupmaster()
    {
        return $this->hasMany(GroupMaster::class, 'section_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

}
