<?php
namespace App\Actions\Ticket;

use App\Assistant;
use App\Http\Requests\Ticket\StoreRequest;
use App\Post;
use App\TicketType;
use App\Voucher;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $assistant = $request->assistant;
        $tickets = collect($request->tickets);
        $answers = $request->answers;

        $assistant = Assistant::create($assistant);

        $ticketAmount = TicketType::whereIn('id', $tickets->pluck('ticket_type_id'))->sum('amount');
        dd($tickets->sum('quantity'));
        $voucherPath = $request->file('assistant.voucher')->store("vouchers/{$assistant->id}");
        $voucher = Voucher::make([
            'file' => $voucherPath,
            'amount' => $tickets->sum('quantity'),
        ]);
        $voucher->assistant()->associate($assistant);
        $voucher->save();

        $toCreateTickets = $tickets->reduce(function ($carrier, $ticket) use ($post, $assistant, $voucher) {
            $this->validateEnoughTickets($post, $ticket['ticket_type_id'], $ticket['quantity']);

            for ($i = 0; $i < $ticket['quantity']; $i++) {
                $carrier[] = [
                    'hash' => hash('sha256', "{$assistant->id}-{$ticket['ticket_type_id']}-{$post->id}-{$voucher->id}-{$i}" . now()->timestamp),
                    'assistant_id' => $assistant->id,
                    'voucher_id' => $voucher->id,
                    'ticket_type_id' => $ticket['ticket_type_id'],
                ];
            }

            return $carrier;
        }, []);

        $post->tickets()->createMany($toCreateTickets);

        if ($answers) {
            $assistant->answers()->createMany($answers);
        }
    }

    private function validateEnoughTickets(Post $post, int $ticket_type_id, int $quantity): void {
        $takenTickets = $post->tickets()->where('ticket_type_id', $ticket_type_id)->count();
        $maxTickets = $post->ticketTypes()->find($ticket_type_id)->quantity;

        throw_if($takenTickets + $quantity > $maxTickets, \Exception::class, 'Not enough tickets');
    }
}
