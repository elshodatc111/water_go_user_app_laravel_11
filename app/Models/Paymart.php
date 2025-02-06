<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymart extends Model
{
    protected $fillable = [
        'company_id',
        'price',
        'description',
    ];
}
