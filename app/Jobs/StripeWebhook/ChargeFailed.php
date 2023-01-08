<?php

namespace App\Jobs\StripeWebhook;

use App\Mail\PaymentFailedMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeFailed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookCall $webhookCall)
    {
        //
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $charge=$this->webhookCall->payload['data']['object'];
        $user=User::where('stripe_id',$charge['customer'])->firstOrFail();
        if ($user){
            $order=Order::where('payment_intent',$charge['payment_intent'])->firstOrFail();
            Mail::to($user)->send(new PaymentFailedMail($order));
        }
    }
}
