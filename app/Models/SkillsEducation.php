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
        return $this->hasMany(UserSkills::class, 'skill_value_id', 'id')->where('type', 1);

    }
    public function secondary_skills_user(){
        return $this->hasMany(UserSkills::class, 'skill_value_id','id')->where('type', 2);

    }
    public function learning_skills_user(){
        return $this->hasMany(UserSkills::class, 'skill_value_id', 'id')->where('type', 3);

    }





}
