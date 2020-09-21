<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Membership plan
     * 
     * @var const
     */
    public const STATUS_BEGINER = 1;
    public const STATUS_INTERMEDIATE = 2;
    public const STATUS_ADVANCED = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'niche',
        'hashtag',
        'cavour_color'
    ];

    /**
     * The user who has these have profiles.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
