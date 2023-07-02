<?php
namespace App\Actions\TicketType;

use App\Http\Requests\TicketType\StoreRequest;
use App\Post;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $post->ticketTypes()->create($request->validated());
    }
}
