<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_status_id',
        'client_code',
        'client_name',
        'client_email',
        'map',
        'team_id',
        'work_type_id',
        'hours',
        'starting_date'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function emp_status(){
        return $this->belongsTo(ClientStatus::class, 'client_status_id', 'id');

    }

    public function work_type(){
        return $this->belongsTo(WorkType::class, 'work_type_id', 'id');

    }

    public function team(){
        return $this->belongsTo(Teams::class, 'team_id', 'id');

    }
}
