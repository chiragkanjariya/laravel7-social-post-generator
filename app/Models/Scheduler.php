<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    protected $table = 'schedulers';

    protected $fillable = [
        'user_id',
        'title',
        'description',
    	'schedule'
    ];
}
