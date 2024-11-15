<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function specialists(){
        return $this->hasMany(Specialist::class);
    }

    public function services(){
        return $this->hasMany(service::class);
    }
}
