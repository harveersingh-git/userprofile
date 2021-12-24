<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningSkills extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_skill_value_id',
        'order',
        'user_id'   
    ];
    public function skills_details(){
        return $this->belongsTo(SkillsEducation::class, 'learning_skill_value_id', 'id');

    }
}
