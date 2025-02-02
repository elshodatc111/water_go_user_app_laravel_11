<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'image',
        'discription',
        'work_time',
        'price',
        'status',
        'balans',
        'tarif',
        'star_count',
        'star',
    ];
}
