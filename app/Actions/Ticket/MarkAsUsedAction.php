<?php
namespace App\Actions\Ticket;

use App\Ticket;

class MarkAsUsedAction {
    public function execute(Ticket $ticket) {
        throw_if($ticket->used_at, \Exception::class, 'El ticket ya fue usado');

        $ticket->update([
            'used_at' => now()
        ]);
    }
}
