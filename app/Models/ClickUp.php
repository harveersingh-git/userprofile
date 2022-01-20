<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickUp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'time'
    ];

    protected $table = 'clickup_report';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
