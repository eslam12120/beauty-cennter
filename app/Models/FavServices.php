<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
       

    ];
 
}
