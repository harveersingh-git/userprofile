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
        'time',
        'daily_performance_id',
        'reason',
        'status'
    ];

    protected $table = 'clickup_report';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function daily_performance()
    {
        return $this->belongsTo(DailyPerformance::class, 'daily_performance_id', 'id');
    }
}
