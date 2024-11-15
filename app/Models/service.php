<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;

 public function Category()
    {

            return $this->belongsTo(Category::class, 'category_id');

    }


    public function specialists()
{
    return $this->belongsToMany(Specialist::class, 'service_specialities', 'service_id', 'specialist_id');
}
}
