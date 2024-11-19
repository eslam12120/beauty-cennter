<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartBooking extends Model
{
    use HasFactory;
    protected $table = 'cart_bookings';
    protected $guarded = [];

    public function category($lang = 'en')
    {
        return $this->belongsTo(Category::class,  'category_id')
            ->select(
                'categories.id',
                $lang === 'en' ? 'categories.name_en as name' : 'categories.name_ar as name'
            );
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class,  'specialist_id')
            ->select(
                'id',
                'name',
            );
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
}
