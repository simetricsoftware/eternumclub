<?php
namespace App\Actions\Voucher;

use App\Mail\Voucher\QrInvitations;
use App\Post;
use App\Voucher;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendMailAction {
    public function execute(Voucher $voucher, Post $post) {

        $qrs = $voucher->tickets->map(function ($ticket) use ($post) {
            $ticket->sent_at = now();
            $ticket->save();

            return QrCode::size(600)
                ->format('png')
                ->margin(2)
                ->generate(route('ticket.mark-as-used', ['post' => $post, 'ticket' => $ticket]));
        });

        Mail::to($voucher->assistant->email)
            ->send(new QrInvitations($qrs, $post));
    }
}
