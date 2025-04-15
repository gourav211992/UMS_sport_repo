<?php
namespace App\Models\ums;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMaster extends Model
{
    use HasFactory, SoftDeletes; // Enable soft deletes

    protected $table = 'master_group';
    protected $dates = ['deleted_at'];


    // Fillable fields
    protected $fillable = ['name','batch_year','status', 'section_id','section_name','batch_name', 'batch_id']; // Mass assignable fields

    // Relationship with Section (each GroupMaster belongs to a Section)
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id'); // Foreign key section_id
    }

    // Relationship with Batch (each GroupMaster belongs to a Batch)
    public function batch()
    {
        return $this->belongsTo(batch::class, 'batch_id'); // Foreign key batch_id
    }



    
    
    
    // protected $fillable = [
    //     'group_name',
    //     'status',
    //     'section_name',
    //     'section_year',
    //     'section_batch'
    // ];

    // Optionally, define a relationship with Section if required
    // public function section()
    // {
    //     return $this->belongsTo(Section::class); // assuming you have a Section model
    // }
    // public function section()
    // {
    //     return $this->belongsTo(Section::class, 'section_id');
    // }
}
