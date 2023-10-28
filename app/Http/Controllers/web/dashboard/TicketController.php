<?php

namespace App\Http\Controllers\web\dashboard;

use App\Actions\Ticket\MarkAsUsedAction;
use App\Http\Controllers\Controller;
use App\Post;
use App\Ticket;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    public function markAsUsed(Post $post, Ticket $ticket, MarkAsUsedAction $action)
    {
        try {
            $action->execute($ticket);
        } catch (\Exception $e) {
            return redirect()->route('ticket.is-invalid', ['post' => $post]);
        }

        return redirect()->route('ticket.is-valid', ['post' => $post]);
    }
}
