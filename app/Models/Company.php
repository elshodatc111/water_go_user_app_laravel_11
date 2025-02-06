<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{
    protected $fillable = [
        'name',
        'phone',
        'time',
        'price',
        'tarif',
        'description',
        'balans',
        'reyting',
        'reyting_count',
        'image_url',
        'status_admin',
        'status_drektor',
    ];
}
