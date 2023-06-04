<?php
namespace App\Http\Query\Question;

use App\Post;
use Illuminate\Database\Eloquent\Builder;

class Index {
    public function query(Post $post): Builder {
        return $post->questions()->getQuery();
    }
}
