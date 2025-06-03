<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviceweb extends Model
{
    use HasFactory;

    protected $table = 'servicewebs';

    protected $fillable = [
        'service_name',
        'picture',
    ];
}
