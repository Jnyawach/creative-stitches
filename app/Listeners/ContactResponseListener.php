<?php

namespace App\Listeners;

use App\Events\ContactResponse;
use App\Mail\ContactResponseEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ContactResponseListener
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
     * @param  \App\Events\ContactResponse  $event
     * @return void
     */
    public function handle(ContactResponse $event)
    {
        //
        Mail::to($event->contact)->send(new ContactResponseEmail($event->contact));
    }
}
