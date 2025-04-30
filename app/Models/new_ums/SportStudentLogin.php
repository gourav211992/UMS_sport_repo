<?php

namespace App\Models\ums;


// use Laravel\Passport\HasApiTokens;
use App\Models\SportRegister;
use App\Models\SportPayment;
use App\Models\Organization;
use App\Models\AuthUser;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SportStudentLogin extends Authenticatable
{
    use  Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'is_email_verified',
        'mobile',
        'is_mobile_verified',
        'is_primary_user',
        'date_of_birth',
        'gender',
    ];
    protected $table = "sport_student";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['profile_image_url'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfileImageUrlAttribute() {
        return  asset('images/default-user-icon.jpg');
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function courseMappings()
    {
        return $this->morphMany(CourseMapping::class, 'morphable');
    }

    public function PaymentDetails(){
        return $this->hasOne(PaymentDetails::class,'user_id');
    }

    public function PersonalInformations(){
        return $this->hasOne(PersonalInformations::class,'user_id');
    }

    public function ApplicationDetails(){
        return $this->hasOne(ApplicationDetails::class,'user_id');
    }

    public function EducationDetails(){
        return $this->hasOne(EducationDetails::class,'user_id');
    }

    public function StudentDetails(){
        return $this->hasOne(StudentDetails::class,'user_id');
    }

    public function PermanentAddress(){
        return $this->hasOne(PermanentAddress::class,'user_id');
    }

    public function UploadDocuments(){
        return $this->hasOne(UploadDocuments::class,'user_id');
    }
    public function registration()
    {
        return $this->hasOne(SportRegister::class, 'userable_id');
    }
    public function payments()
    {
        return $this->hasOne(SportPayment::class, 'user_id');
    }
    public function organization()
    {
        return $this->belongsTo(\App\Models\Organization::class, 'organization_id', 'id');
    }


    public function getInitials()
    {
        $nameParts = explode(' ', $this->name);
        $initials = '';

        foreach ($nameParts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials;
    }

    public function access_rights_org()
    {
        return NULL;
    }




    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('alias', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function organizations() {

        return $this->belongsToMany(Organization::class, 'employee_organization_mapping', 'employee_id', 'organization_id');

    }

    public function auth_user()
    {
        return $this -> belongsTo(AuthUser::class, 'id', 'authenticable_id');
    }
    public function getAuthenticableTypeAttribute()
    {
        return $this -> auth_user -> authenticable_type ??null;
    }

    public function getAuthUserIdAttribute()
    {
        return $this -> auth_user -> id??null;
    }

    public function getDbNameAttribute()
    {
        return $this->auth_user->db_name ?? '';
    }
    public function groupOrganizationsIds()
    {
        if (isset($this->organization->group->organizations)) 
        {
            return $this->organization->group->organizations->pluck('id')->toArray();

        } else {
            return [$this->organization->id];
        }

    }

}
