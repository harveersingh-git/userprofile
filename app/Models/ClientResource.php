<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientResource extends Model
{
    use HasFactory;
    protected $fillable = [

        'client_id',
        'working_user_id',
        'hire_user_id',
        'month',
        'year',
        'start_date',
        'end_date',
        'hours'
    ];

    public function working_resource()
    {
        return $this->belongsTo(User::class, 'working_user_id', 'id')->with(['client_status_value', 'work_status_value']);
    }
    public function hire_resource()
    {
        return $this->belongsTo(User::class, 'hire_user_id', 'id')->with(['client_status_value', 'work_status_value']);
    }
}
