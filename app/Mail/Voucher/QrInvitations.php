<?php

namespace App\Mail\Voucher;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class QrInvitations extends Mailable
{
    use Queueable, SerializesModels;

    public $qrs;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $qrs, Post $post)
    {
        $this->qrs = $qrs;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = $this->view('emails.voucher.qr-sent');

        $index = 1;
        $this->qrs->each(function ($qr) use ($view, &$index) {
            $view->attachData($qr, 'qr-' . $index . '.png');
            $index++;
        });

        return $view->with([
            'post' => $this->post,
        ])
        ->subject('Entradas a ' . $this->post->title);
    }
}
