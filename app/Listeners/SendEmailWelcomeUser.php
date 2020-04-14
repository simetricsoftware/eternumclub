<?php

namespace App\Listeners;

use App\Events\UserCreated as UserEvent;
use App\Mail\UserCreated as UserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailWelcomeUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserEvent  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        Mail::to($event->user->email)->send(new UserMail($event->user, $event->password));
    }
}
