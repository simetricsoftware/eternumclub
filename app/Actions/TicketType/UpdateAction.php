<?php
namespace App\Actions\TicketType;

use App\Http\Requests\TicketType\StoreRequest;
use App\TicketType;

class UpdateAction {
    public function execute(StoreRequest $request, TicketType $ticketType) {
        $ticketType->update($request->validated());
    }
}
