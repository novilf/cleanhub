<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMobile extends Model
{
    protected $table = 'usermobiles';

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'profile_photo'
    ];

    // Relasi one-to-many ke Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}

