<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\Voteable;

class Post extends Model
{
    use Voteable;

    protected $fillable = [
        'title', 'slug', 'content', 'category_id', 'status', 'image_url', 'user_id'
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

    public function ticketTypes() {
        return $this->hasMany(TicketType::class);
    }

    public function scopeUserRole($query) {
        $user = auth()->user();
        if(!$user->hasRole('admin') && !$user->hasRole('moderator'))
            return $query->where('user_id',$user->id);
    }

    public function scopeSearch($query, $keyword) {
        if (isset($keyword)) {
            return $query->where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%");
        }
    }

    public function scopeSortByCategory($query, $category) {
        if( $category && $category !== 'all' )
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('title', $category);
            });
    }

    public function setTags($tags) {
        if(array_key_exists('tags', $tags)) $this->tags()->sync($tags['tags']);
        else $this->tags()->detach();
    }

    public function getFullPathImageAttribute() {
        return Storage::url($this->image_url);
    }
}
