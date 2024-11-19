<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeService extends Model
{
    protected $guarded = [];
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
}
