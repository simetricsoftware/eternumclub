<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'vote_type', 'user_id', 'comment_id'
    ];

    public function voteable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
