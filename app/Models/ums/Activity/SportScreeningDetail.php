<?php

namespace App\Models\ums\Activity;
use App\Models\SportRegister;
use App\Models\ums\GroupMaster;
use App\Models\ums\batch;
use App\Models\ums\Section;
use App\Models\ums\Sport_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportScreeningDetail extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];

    protected $table = 'sport_screening_details';
    public $timestamps = false;

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id', // Mass assignable fields
        'screening_date',
        'batch_year',
        'batch_id',
        'section_id',
        'trainer_id',
        'sports_group_id',
        'registration_id',
        'screening_id',
        'parameter_values',
    ];

    protected $casts = [
        'parameter_values' => 'array',
        'screening_date' => 'date',

    ];

    // Relationships (assuming you have these models)
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // public function trainer()
    // {
    //     return $this->belongsTo(Trainer::class);
    // }

    public function group()
    {
        return $this->belongsTo(GroupMaster::class);
    }

    public function registration()
    {
        return $this->belongsTo(SportRegister::class);
    }

    public function screening()
    {
        return $this->belongsTo(SportScreeningMaster::class);
    }
}
