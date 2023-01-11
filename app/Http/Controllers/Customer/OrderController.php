<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Embroidery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Auth::user();

         $orders=OrderResource::collection(Order::where('user_id',$user->id)
         ->where('status','Paid')
             ->when(request('search'),function ($query,$search){
                 $query->where('order_code','like', '%'.$search.'%');
             })
             ->with('products.size','products.embroideries')->paginate(1));

        $filters=request()->only(['search']);
        return inertia::render('account.orders.index',compact('orders','filters'));
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

    public function downloadArtwork($embroidery,$order){
        $order=Order::findOrFail($order);
        if ($order->status==='Paid' && $order->user_id===Auth::id()){
            $embroidery=Embroidery::findOrFail($embroidery);
            if (Storage::disk('artworks')->exists($embroidery->file_name)) {
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
                return Storage::disk('artworks')->download($embroidery->file_name,$embroidery->file_name,$headers);


            }else{
                return redirect()->back()
                    ->with('status','It seems like the file is missing, please contact support for assistance');
            }

        }else{
            return redirect()->back()
                ->with('status','Error Downloading file. Please contact support for assistance');
        }
    }


}
