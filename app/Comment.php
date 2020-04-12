<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Voteable;

class Comment extends Model
{
    use Voteable;

    protected $fillable = [
        'content', 'likes', 'post_id', 'user_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function votes() {
        return $this->morphMany('App\Vote', 'voteable');
    }
}
