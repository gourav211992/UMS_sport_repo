<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name' , 'batch' ,'year', 'batch_id','status'];

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
