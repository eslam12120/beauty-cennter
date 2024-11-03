<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function services()
    {
        return $this->belongsToMany(service::class , 'service_specialities' , 'specialist_id' , 'service_id' );
    }
}
