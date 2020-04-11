<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'category_id', 'status', 'image_post_id', 'user_id'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function image() {
        return $this->belongsTo('App\Image');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function votes() {
        return $this->morphMany('App\Vote', 'voteable');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function scopeUserRole($query) {
        $user = auth()->user();
        if(!$user->hasRole('admin') && !$user->hasRole('moderator'))
            return $query->where('user_id',$user->id);
    }

    public function scopeSortByCategory($query, $category) {
        if( $category && $category !== 'all' )
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('title', $category);
            });
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

    public function setTags($tags) {
        if(array_key_exists('tags', $tags)) $this->tags()->sync($tags['tags']);
        else $this->tags()->detach();
    }
}
