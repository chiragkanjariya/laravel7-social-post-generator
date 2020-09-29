<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'post_title', 'post_content', 'post_image', 'profile_id', 'isoverlay',
  ];

  /**
   * The profile which has the posts.
   * 
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function profile(): BelongsTo
  {
    return $this->belongsTo(Profile::class);
  }
}
