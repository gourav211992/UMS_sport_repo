<?php

namespace App\Models\ums;
use App\Models\ums\Faculty;
use App\Models\ums\Semester;
use App\Models\ums\Course;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    public function course() {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }
    public function faculty() {
        return $this->belongsTo(faculty::class, 'faculty_id')->withTrashed();
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id')->withTrashed();
    }
}
