<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserSkills;
use App\Models\UserEducation;
use App\Models\UserExperince;
use App\Models\Certification;
use App\Models\LearningSkills;
use App\Models\userAchievement;
use App\Models\UserProject;
use Illuminate\Database\Eloquent\SoftDeletes;





class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'employee_id',
        'resume_title',
        'mobile',
        'joining_date',
        'shift_start',
        'shift_end',
        'team',
        'about_employee',
        'experience'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

   
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getEmployeeIdAttribute($value)
    {
        return strtoupper($value);
    }
  

    public function skills(){
        return $this->hasMany(UserSkills::class, 'user_id', 'id')->with('skills_details');

    }

    public function education(){
        return $this->hasMany(UserEducation::class, 'user_id', 'id');

    }
    public function certification(){
        return $this->hasMany(Certification::class, 'user_id', 'id');

    }
    public function exprince(){
        return $this->hasMany(UserExperince::class, 'user_id', 'id');

    }
     
    public function learning_skills(){
        return $this->hasMany(LearningSkills::class, 'user_id', 'id')->with('skills_details');

    }
    public function achievement(){
        return $this->hasMany(userAchievement::class, 'user_id', 'id');

    }

    public function project(){
        return $this->hasMany(UserProject::class, 'user_id', 'id');

    }
    

    
}
