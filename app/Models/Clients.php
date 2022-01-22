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
        // 'team_id',
        'work_type_id',
        'hours',
        'starting_date',
        'end_date',
        'client_type_id',
        'hours_cunsumed'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id')->with('myTeam');

    }

    public function client_status(){
        return $this->belongsTo(ClientStatus::class, 'client_status_id', 'id');

    }

  

    public function work_type(){
        return $this->belongsTo(WorkType::class, 'work_type_id', 'id');

    }
    public function client_type(){
        return $this->belongsTo(ClientType::class, 'client_type_id', 'id');

    }

    // public function team(){
    //     return $this->belongsTo(Teams::class, 'team_id', 'id');

    // }
    public function client_resource(){
        return $this->hasMany(ClientResource::class, 'client_id', 'id')->with(['working_resource','hire_resource']);;

    }
    

  
}
