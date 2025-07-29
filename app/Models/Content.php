<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_weekday',
        'price_weekend',
        'open_time',
        'close_time',
        'location',
        'image',
    ];
}
