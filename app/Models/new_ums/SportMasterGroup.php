<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportMasterGroup extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = ['name','organization_id',
        'group_id',
        'company_id'];
    protected $table = "sport_master_group";
    // Define relationships
    public function parentGroups()
    {
        return $this->hasMany(ParentGroup::class, 'master_group_id', 'id');
    }
}
