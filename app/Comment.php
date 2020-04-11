<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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

    public function scopeVotesCount($query) {
        return $query->withCount([
            'votes', 'votes as likes' => function($vote) {
                $vote->where('vote_type','like');
            },
            'votes', 'votes as dislikes' => function($vote) {
                $vote->where('vote_type','dislike');
            }
        ]);
    }

    public function scopeVotesUser($query, $user) {
        if ($user) {
            return $query->with([
                'votes' => function($vote) use ($user){
                    $vote->where('user_id', $user->id);
                }
            ]);
        }
    }
}
