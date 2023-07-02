<?php
namespace App\Actions\Ticket;

use App\Assistant;
use App\Http\Requests\Ticket\StoreRequest;
use App\Post;
use App\Voucher;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class StoreAction {
    public function execute(StoreRequest $request, Post $post) {
        $assistant = $request->assistant;
        $tickets = collect($request->tickets);
        $answers = $request->answers;

        $assistant = Assistant::create($assistant);

        $tempUrl = Storage::putFile("vouchers/{$assistant->id}", $request->file('assistant.voucher'));
        $voucherPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $tempUrl);

        Artisan::call('optimize:image', [
            '--use-webp' => true,
            '--input' => $tempUrl,
            '--output' => $voucherPath,
            '--disk' => 'public',
        ]);

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
            $answers = collect($answers)->map(function ($answer) use ($voucher) {
                return [
                    'question_id' => $answer['question_id'],
                    'response' => $answer['response'],
                    'voucher_id' => $voucher->id,
                ];
            })->toArray();
            $assistant->answers()->createMany($answers);
        }
    }

    private function validateEnoughTickets(Post $post, int $ticket_type_id, int $quantity): void {
        $takenTickets = $post->tickets()->where('ticket_type_id', $ticket_type_id)->count();
        $maxTickets = $post->ticketTypes()->find($ticket_type_id)->quantity;

        throw_if($takenTickets + $quantity > $maxTickets, \Exception::class, 'Not enough tickets');
    }
}
