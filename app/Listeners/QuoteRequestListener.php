<?php

namespace App\Listeners;

use App\Events\QuoteRequestEvent;
use App\Mail\QuoteRequestEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class QuoteRequestListener
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
     * @param  \App\Events\QuoteRequestEvent  $event
     * @return void
     */
    public function handle(QuoteRequestEvent $event)
    {
        //
        Mail::to($event->quote)->send(new QuoteRequestEmail($event->quote));
    }
}
