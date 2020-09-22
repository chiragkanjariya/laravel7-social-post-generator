<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niche extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'niches';

    /**
     * The profiles has all profiles of oneself.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class, 'niche_id', 'id');
    }
}
