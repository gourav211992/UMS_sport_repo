<?php

namespace App\Models\ums;

use App\Traits\DefaultGroupCompanyOrg;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class sport_fee_master extends Model
{
    use HasFactory, SoftDeletes, DefaultGroupCompanyOrg;

    protected $table = 'sport_fee_master';
    protected $fillable = [
        'series',
        'organization_id',
        'document_type',
        'book_id',
        'document_number',
        'document_date',
        'document_status',
        'approval_level',
        'revision_number',
        'revision_date',
        'schedule_no',
        'admission_year',
        'part_name',
        'section',
        'exam',
        'index_status',
        'file_details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    protected $dates = ['deleted_at'];

    protected $casts = [
        'fee_details' => 'array',
    ];
}

