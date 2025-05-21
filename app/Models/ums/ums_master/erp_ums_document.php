<?php

namespace App\Models\ums\ums_master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class erp_ums_document extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'erp_ums_documents';
    protected $fillable = [
        'organization_id',
        'group_id',
        'company_id',
        'document_code',
        'document_name',
        'document_type',
        'description',
        'status',
    ];
    public function categoryProgDocs()
    {
        return $this->hasMany(CategoryProgDoc::class, 'document_category_id');
    }
}
