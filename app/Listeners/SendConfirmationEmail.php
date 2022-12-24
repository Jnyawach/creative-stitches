<?php

namespace App\Listeners;

use App\Events\ContactConfirmation;
use App\Mail\ContactConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmail
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
     * @param  \App\Events\ContactConfirmation  $event
     * @return void
     */
    public function handle(ContactConfirmation $event)
    {
        //
        Mail::to($event->message)->send(new ContactConfirmationEmail($event->message));
    }
}
