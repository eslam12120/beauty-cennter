<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSpecialist extends Model
{
    protected $guarded = [];
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
    public function services()
    {
        return $this->belongsTo(service::class, 'service_id');
    }
    

}
