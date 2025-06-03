<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';  // pastikan table

    protected $fillable = [
        'user_id', 'date', 'service_type', 'detail_clothes', 'price', 'payment_status', 'laundry_status'
    ];

    // Relasi ke usermobile berdasarkan foreign key user_id
    public function usermobile()
    {
        return $this->belongsTo(Usermobile::class, 'user_id');
    }
}
