<?php
namespace App\Http\Query;

use App\Post;
use Illuminate\Database\Eloquent\Builder;

class TicketTypeIndex {
    public function query(Post $post): Builder {
        return $post->ticketTypes()->getQuery();
    }
}
