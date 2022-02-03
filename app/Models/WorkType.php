<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'background_color',
        'font_color'
    ];

    protected $table = 'work_types';

    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function work_type_user_count(){
        return $this->hasMany(User::class, 'work_type', 'id');

    }
}
