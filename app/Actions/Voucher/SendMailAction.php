<?php
namespace App\Actions\Voucher;

use App\Mail\Voucher\QrInvitations;
use App\Post;
use App\Voucher;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendMailAction {
    public function execute(Voucher $voucher, Post $post) {

        $qrs = $voucher->tickets->map(function ($ticket) {
            $ticket->sent_at = now();
            $ticket->save();

            $qr = QrCode::size(600)
                ->style('round')
                ->format('png')
                ->margin(2)
                ->generate($ticket->hash);

            return [
                'qr' => $qr,
                'hash' => $ticket->hash,
            ];
        });

        Mail::to($voucher->assistant->email)
            ->send(new QrInvitations($qrs, $post));
    }
}
