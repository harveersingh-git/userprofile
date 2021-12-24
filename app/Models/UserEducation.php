<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'degree_type_id',
        'order',
        'user_id',
        'education_title_id',
        'from',
        'to'
        
    ];
}
