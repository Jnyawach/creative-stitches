<?php

namespace App\Providers;

use App\Events\ContactResponse;
use App\Events\QuoteRequestEvent;
use App\Listeners\ContactResponseListener;
use App\Listeners\QuoteRequestListener;
use App\Listeners\SendConfirmationEmail;
use App\Mail\ContactResponseEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ContactConfirmation;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ContactConfirmation::class => [
            SendConfirmationEmail::class,
        ],

        ContactResponse::class => [
           ContactResponseListener::class,
        ],

        QuoteRequestEvent::class => [
            QuoteRequestListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
