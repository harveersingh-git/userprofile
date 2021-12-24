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

   

}
