<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'description',
        'rate'


    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'image', 'email');
    }
}
