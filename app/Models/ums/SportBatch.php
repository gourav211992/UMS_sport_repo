<?php

namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SportBatch extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    public $table='sport_batches';
    protected $fillable=['batch_name','batch_year','start_date','end_date','status','organization_id',
        'group_id',
        'company_id'];
    protected $guarded=[];

    public function sections()
    {
        return $this->hasMany(SportSection::class);
    }

}
