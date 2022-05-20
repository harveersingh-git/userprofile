<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'background_color',
        'font_color',
        'order_by',
        'image',
        'icon'
    ];

    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }
    public function client_status_count()
    {
        return $this->hasMany(User::class, 'client_status', 'id');
    }
}
