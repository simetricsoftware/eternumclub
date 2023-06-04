<?php
namespace App\Actions\Ticket;

use App\Guest;
use App\Http\Requests\Ticket\StoreRequest;
use App\Post;
use App\Voucher;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $guest = $request->guest;
        $tickets = collect($request->tickets);
        $answers = $request->answers;

        $guest = Guest::create($guest);

        $voucherPath = $request->file('guest.voucher')->store("vouchers/{$guest->id}");
        $voucher = Voucher::make([
            'file' => $voucherPath,
        ]);
        $voucher->guest()->associate($guest);
        $voucher->save();

        $toCreateTickets = $tickets->reduce(function ($carrier, $ticket) use ($post, $guest, $voucher) {
            $this->validateEnoughTickets($post, $ticket['ticket_type_id'], $ticket['quantity']);

            for ($i = 0; $i < $ticket['quantity']; $i++) {
                $carrier[] = [
                    'hash' => hash('sha256', "{$guest->id}-{$ticket['ticket_type_id']}-{$post->id}-{$voucher->id}-{$i}" . now()->timestamp),
                    'guest_id' => $guest->id,
                    'voucher_id' => $voucher->id,
                    'ticket_type_id' => $ticket['ticket_type_id'],
                ];
            }

            return $carrier;
        }, []);

        $post->tickets()->createMany($toCreateTickets);

        if ($answers) {
            $guest->answers()->createMany($answers);
        }
    }

    private function validateEnoughTickets(Post $post, int $ticket_type_id, int $quantity): void {
        $takenTickets = $post->tickets()->where('ticket_type_id', $ticket_type_id)->count();
        $maxTickets = $post->ticketTypes()->find($ticket_type_id)->quantity;

        throw_if($takenTickets + $quantity > $maxTickets, \Exception::class, 'Not enough tickets');
    }
}
