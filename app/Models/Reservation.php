<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'customer',
        'date',
        'time',
        'guests',
        'phone',
        'status',
    ];
}
