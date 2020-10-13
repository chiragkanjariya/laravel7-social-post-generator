<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scheduler extends Model
{
    protected $table = 'schedulers';

    protected $fillable = [
        'user_id',
        'title',
        'description',
    	'schedule'
    ];

    /**
     * The user who has these have scheduler.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The post who has specified schedule.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
