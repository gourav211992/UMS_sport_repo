<?php

namespace App\Models\ums\ums_master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProgDoc extends Model
{
    use HasFactory;
    protected $table = 'erp_ums_category_prog_doc';

    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'document_category_id',
        'course_id',
        'cat_prog_doc_code',
        'cat_prog_doc_name',
        'status',
        'document_required',
        'document_details',
    ];

    protected $casts = [
        'document_required' => 'boolean',
        'document_details' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }

    public function documentCategory()
    {
        return $this->belongsTo(erp_ums_document::class, 'document_category_id');
    }
}
