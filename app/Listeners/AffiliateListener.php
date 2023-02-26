<?php

namespace App\Listeners;

use App\Events\AffiliateSubmit;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AffiliateListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected  $request;
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AffiliateSubmit  $event
     * @return void
     */
    public function handle(AffiliateSubmit $event)
    {
        //
        $order=$event->order;
        $affiliate= $this->request->cookie('affiliatly_v3');
        Log::info($affiliate);
        if ($affiliate){
            $client = new Client();
            $res = $client->request('POST', 'https://www.affiliatly.com/api_request.php', [
                'form_params' => [
                    'mode'=>'mark_php',
                    'id_affiliatly'=>'AF-1060728',
                    'id_user'=>$affiliate['id_user'],
                    'id_hash'=>$affiliate['id_token'],
                    'id_order'=>$order->order_code,
                    'id_affiliate'=>$affiliate['aff_uid'],
                    'price'=>$order->amount,
                    'security_hash'=>config('affiliate.affiliate_secret'),
                    'from'=>'php'
                ]
            ]);
        }

    }
}
