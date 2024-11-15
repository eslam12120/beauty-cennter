<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }
   
    
    public function services($lang = 'en')
{
    return $this->belongsToMany(service::class, 'service_specialities', 'specialist_id', 'service_id')
                ->select('services.id', 'services.specialist_id', 
                         $lang === 'en' ? 'services.service_name_en as service_name' : 'services.service_name_ar as service_name');
}
    
}
