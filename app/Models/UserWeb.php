<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $table = 'user_webs';

protected $fillable = [
    'email',
    'phone_number',
    'account_number',
    'password',
    'laundry_name',
    'laundry_address',
    'description',
];

}
