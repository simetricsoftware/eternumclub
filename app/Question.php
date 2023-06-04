<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'statement', 'type', 'options', 'post_id'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
