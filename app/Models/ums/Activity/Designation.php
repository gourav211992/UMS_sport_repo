<?php

namespace App\Models\ums\Activity;

use App\Models\ums\Activity\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use SoftDeletes;

    protected $table = 'designations'; 

    protected $fillable = [
        'organization_id',
        'name',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $dates = ['deleted_at'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'designation_id');
    }
}
