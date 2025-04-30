<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportSection extends Model
{
    use HasFactory;
    protected $table = "sport_sections";
    protected $fillable = ['name' , 'batch' ,'year', 'batch_id','status','organization_id',
        'group_id',
        'company_id'];

    protected $guarded=[];

    public function groupmaster()
    {
        return $this->hasMany(GroupMaster::class, 'section_id');
    }

    public function batch()
    {
        return $this->belongsTo(sportBatch::class);
    }

}
