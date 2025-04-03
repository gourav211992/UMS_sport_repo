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
    protected $fillable = [
        'group_name',
        'status',
        'section_id',
    ];

    // Optionally, define a relationship with Section if required
    // public function section()
    // {
    //     return $this->belongsTo(Section::class); // assuming you have a Section model
    // }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
