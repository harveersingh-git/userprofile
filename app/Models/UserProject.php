<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order',
        'team_size',
        'project_name',
        'project_skills',
        'project_description',
        'url'
        
        
    ];
    public function getProjectNameAttribute($value)
    {
        return strtoupper($value);
    }
}
