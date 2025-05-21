<?php

namespace App\Models\ums\activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SportRegister;

class SportReportComment extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];

    protected $table = 'sport_report_comments';
    public $timestamps = false;

    
    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'screening_date',
        'trainer_id',
        'registration_id',
        'remark','created_at',
        'updated_at',

    ];

    protected $casts = [
        'remark' => 'array',  // Automatically decode JSON into array
        'screening_date' => 'date',
    ];

    public function registration()
    {
        return $this->belongsTo(SportRegister::class);
    }

}
