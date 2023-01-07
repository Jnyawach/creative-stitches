<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Format;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CustomerCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return inertia::render('cart.index');
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


        if ($item=\Cart::get($id)){

            return redirect()->back()
                ->with('status','Item already exist in the basket');

        }else{
            $product=Product::findOrFail($id);
            $image=$product->getFirstMediaUrl('mainImage','mainImage-icon');
            $designs=$product->embroideries()->pluck('format_id');
            $format=Format::whereIn('id',$designs)->pluck('abbreviation');

            $cartItem = \Cart::add(['id'=>$product->id, 'name'=>$product->name,
                'price'=>$product->price, 'quantity'=>1,
            'attributes'=>['image'=>$image,
                'format'=>implode(',',$format->toArray()),
                'size_mm'=>$product->design_size_mm,
                'size_inches'=>$product->design_size_inches,
                'stitches'=>$product->total_stitches]]);
        }
        return redirect()->back()
            ->with('status','Item Successfully added to basket');


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
        \Cart::remove($id);
        return redirect()->back()
            ->with('status','Item Successfully removed from the basket');
    }

    public function cartContent(){


        return    $cart = array([
            'items' => \Cart::getContent(),
            'cartCount' => \Cart::getTotalQuantity(),
            'cartSubTotal' => \Cart::getSubTotal(),
            'cartTotal' => \Cart::getTotal(),
        ]);
    }

    public function moveWishlist($id){

        \Cart::remove($id);
        if ($wishlist=Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first()){
            return  redirect()->back()
                ->with('status', 'Product already in wishlist');
        }
        $wishlist=Wishlist::create([
            'user_id'=>Auth::id(),
            'product_id'=>$id,
        ]);
        return  redirect()->back()
            ->with('status', 'Product added to wishlist');

    }

    public function enterPromo(Request $request){

        $validated=$request->validate([
            'code'=>'required|string|max:6|exists:coupons'
        ],[
            'exists'=>'The code provided is incorrect. Please check and try again'
        ]);

        $coupon=Coupon::where('code', $validated['code'])->latest()->first();
        if (Carbon::today()>$coupon->expires){
           return redirect()->back()
           ->withErrors([
               'code'=>'The promo code is expired'
           ])->onlyInput('code');
        }

        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Coupon Code',
            'type' => 'Sales',
            'target' => 'total',
            'value' => '-'.$coupon->discount.'%',
        ));
        \Cart::condition($condition);

        return redirect()->back()
            ->with('status','Promo Code applied Successfully');

    }

}
