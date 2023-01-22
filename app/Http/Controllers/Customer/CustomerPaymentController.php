<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(\Cart::isEmpty()){
            return redirect()->route('shop.index');
        }
        $order=Order::where('user_id',Auth::id())->count();
        if ($order<1){
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'First Order Discount',
                'type' => 'Sales',
                'target' => 'total',
                'value' => '-10%',
            ));

            \Cart::condition($condition);
        }


        $products=array();
        foreach (\Cart::getContent() as $item){
            array_push($products, $item->id);
        }

        //Submit Stripe request
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $checkout=$stripe->checkout->sessions->create([
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'line_items' => [
                [
                   'price_data'=>[
                       'currency'=>'usd',
                       'unit_amount'=>number_format(\Cart::getTotal(),2)*100,
                       'product_data'=>[
                          'name'=>'Machine Embroidery Design'
                       ],
                   ],
                    'quantity' => 1,

                ],
            ],
            'customer'=>Auth::user()->stripe_id,
            'mode' => 'payment',
            'payment_intent_data'=>[
               'metadata'=>$products
            ]

        ]);

       //return $checkout;

        return inertia::render('account.payment.index', compact('checkout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentCancel(){
        return inertia::render('account.payment.unsuccessful');
    }
    public function paymentSuccess(){
        \Cart::clear();
        return inertia::render('account.payment.success');

    }
}
