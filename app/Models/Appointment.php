<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{


protected $fillable = [
    'user_id',
        'service_id',
        'start_time',
        'end_time',
        'status',
        'notes',
];


public function service()
{
    return $this->belongsTo(\App\Models\Service::class);
}

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}