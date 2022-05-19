<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkills extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_value_id',
        'order',
        'user_id',
        'type',
        'show_on_front'
        
    ];
    // protected $visible = ['id', 'skill_value_id','order','skills_details'];

    public function skills_details(){
        return $this->belongsTo(SkillsEducation::class, 'skill_value_id', 'id');

    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
}
