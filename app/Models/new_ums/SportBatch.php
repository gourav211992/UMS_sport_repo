<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportBatch extends Model
{
    use HasFactory;
    public $table='sport_batches';
    protected $fillable=['batch_name','batch_year','status','organization_id',
        'group_id',
        'company_id'];
    protected $guarded=[];

    public function sections()
    {
        return $this->hasMany(SportSection::class);
    }

}
