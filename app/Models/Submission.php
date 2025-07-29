<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submission';

    protected $fillable = [
        'vendor',
        'apply_date',
        'start_date',
        'end_date',
        'name_event',
        'file',
        'ktp',
        'appl_letter',
        'actv_letter',
        'status',
        'notes',
    ];
}
