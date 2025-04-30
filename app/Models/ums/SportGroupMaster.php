<?php
namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportGroupMaster extends Model
{
    use HasFactory, SoftDeletes; // Enable soft deletes

    protected $table = 'sport_master_group';
    protected $dates = ['deleted_at'];


    // Fillable fields
    protected $fillable = ['name','batch_year','status', 'section_id','section_name','batch_name', 'batch_id','organization_id',
        'group_id',
        'company_id']; // Mass assignable fields

    // Relationship with SportSection (each GroupMaster belongs to a SportSection)
    public function section()
    {
        return $this->belongsTo(SportSection::class, 'section_id'); // Foreign key section_id
    }

    // Relationship with Batch (each GroupMaster belongs to a Batch)
    public function batch()
    {
        return $this->belongsTo(SportBatch::class, 'batch_id'); // Foreign key batch_id
    }






    // protected $fillable = [
    //     'group_name',
    //     'status',
    //     'section_name',
    //     'section_year',
    //     'section_batch'
    // ];

    // Optionally, define a relationship with SportSection if required
    // public function section()
    // {
    //     return $this->belongsTo(SportSection::class); // assuming you have a SportSection model
    // }
    // public function section()
    // {
    //     return $this->belongsTo(SportSection::class, 'section_id');
    // }
}
