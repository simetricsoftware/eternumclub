<?php
namespace App\Actions\TicketType;

use App\TicketType;

class DeleteAction {
    public function execute(TicketType $ticketType) {
        $ticketType->delete();
    }
}
