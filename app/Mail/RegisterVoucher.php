<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterVoucher extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( 
        private string $hash,
        private string $email,
        private string $name,
        private string $phone,
        private string $voucher,
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.register_voucher')->with([
            'hash'      => $this->hash,
            'email'     => $this->email,
            'name'      => $this->name,
            'phone'     => $this->phone,
            'voucher'   => $this->voucher,
        ]);
    }
}
