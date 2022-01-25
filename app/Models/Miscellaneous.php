<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miscellaneous extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'miscellaneous_title',
        'miscellaneous'
    ];
}
