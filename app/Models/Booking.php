<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
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
    public function Category()
    {

        return $this->belongsTo(Category::class, 'category_id');
    }
    public function services($lang = 'en')
    {
        return $this->belongsTo(service::class,  'service_id')
            ->select(
                'services.id',
                $lang === 'en' ? 'services.service_name_en as name' : 'services.service_name_ar as name',
                'image'
            );
    }
    public function time_specialist()
    {
        return $this->belongsTo(TimeSpecialist::class, 'time_specialist_id')->select(
            'id',
            'start_time'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'image');
    }
}
