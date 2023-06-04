<?php
namespace App\Http\Query\TicketType;

use App\Post;
use Illuminate\Database\Eloquent\Builder;

class Index {
    public function query(Post $post): Builder {
        return $post->ticketTypes()->getQuery();
    }
}
