<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillsEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'category',
        'show_on_front'
        
    ];
    protected $hidden = [
       
        'remember_token',
    ];
    public function getValueAttribute($value)
    {
        return strtoupper($value);
    }
    public function checkSkills(){
        return $this->hasOne(UserSkills::class, 'skill_value_id', 'id');

    }

    
    public function checkLearningSkills(){
        return $this->hasOne(LearningSkills::class, 'learning_skill_value_id', 'id');

    }

    public function primary_skills_user(){
        return $this->hasMany(UserSkills::class, 'skill_value_id', 'id')->where('type', 1)->whereHas('user');

    }
    public function secondary_skills_user(){
        return $this->hasMany(UserSkills::class, 'skill_value_id','id')->where('type', 2)->whereHas('user');

    }
    public function learning_skills_user(){
        return $this->hasMany(UserSkills::class, 'skill_value_id', 'id')->where('type', 3)->whereHas('user');

    }

    public function active_skills(){
        return $this->hasMany(UserSkills::class, 'skill_value_id', 'id')->whereHas('user');

    }




}
