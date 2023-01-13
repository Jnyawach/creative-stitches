<?php

namespace App\Jobs\StripeWebhook;

use App\Mail\OrderConfirmatonEmail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeSucceeded implements ShouldQueue
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
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge=$this->webhookCall->payload['data']['object'];
        $user=User::where('stripe_id',$charge['customer'])->firstOrFail();
        Log::info('Hook Hit');
        if ($user){
            Log::info('Hook Hit');
            $order=Order::where('payment_intent',$charge['payment_intent'])->firstOrFail();
            Payment::create([
                'user_id'=>$user->id,
                'sub_total'=>$charge['amount']/100,
                'total'=>$charge['amount']/100,
                'stripe_id'=>$charge['id'],
                'order_id'=>$order->id,

            ]);
            $order->update([
                'status'=>'Paid']);
            Mail::to($user)->send(new OrderConfirmatonEmail($order));
        }

    }
}
