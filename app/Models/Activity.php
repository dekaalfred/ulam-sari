<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'dot',
        'text',
        'sub',
        'time_label',
    ];
}
