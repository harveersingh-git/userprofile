<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperince extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order',
        'company_name',
        'designation',
        'role_responsibilitie',
        'from',
        'to',
        'present',
        
        
    ];
}
