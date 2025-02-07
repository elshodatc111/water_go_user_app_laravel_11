<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'count',
        'addres',
        'latuda',
        'longitude',
        'status',
        'create_time',
        'pedding_time',
        'succes_time',
        'cancel_time',
        'cancel_discription',
        'currer_id',
        'reyting_status',
        'reyting',
        'reyting_discription',
    ];
}