<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'vendor',
        'start_date',
        'end_date',
        'name_event',
        'file',
    ];

}
