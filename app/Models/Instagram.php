<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    protected $table = 'instagrams';

    protected $fillable = [
        'profile_id',
        'followers',
        'best_hashtags',
        'posts',
        'advices'
    ];
}
