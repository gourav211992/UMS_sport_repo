<?php

namespace App\Models;

use App\Traits\DefaultGroupCompanyOrg;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ums\batch;

class SportRegister extends Model
{
    use HasFactory, DefaultGroupCompanyOrg;

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'book_id',
        'document_number',
        'document_date',
        'doc_number_type',
        'doc_reset_pattern',
        'doc_prefix',
        'doc_suffix',
        'doc_no',
        'document_status',
        'approval_level',
        'revision_number',
        'revision_date',
        'name',
        'middle_name',
        'last_name',
        'userable_id',
        'type',
        'interaction_date',
        'sport_id',
        'quota_id',
        'dob',
        'doj',
        'status',
        'image',
        'others_id',
        'medical',
        'hostel',
        'family',
        'address',
        'emergency',
        'sponsor',
        'fee',
        'document',
        'mobile_number',
        'email',
        'batch_id',
        'section_id',
        'group',
        'bai_id',
        'bai_state',
        'bwf_id',
        'country',
        'hostel_required',
        'check_in_date',
        'check_out_date',
        'room_preference',
        'hostel_id',
        'hostel_present',
        'hostel_absent',
        'hostel_absence_reason',
        'gender',
        'remarks',
        'registration_number',
        'payment_reason'
    ];

    public function trainingDetails()
    {
        return $this->hasMany(SportTrainingDetail::class, 'registration_id');
    }

    public function registrationDetails()
    {
        return $this->hasOne(SportRegistrationDetail::class, 'registration_id');
    }
    public function registration(){
        return $this->hasOne(\App\models\ums\User::class, 'userable_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userable_id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
