<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews=ReviewResource::collection(Review::where('user_id',Auth::id())->with('product')->paginate(5));

        return inertia::render('account.reviews.index', compact('reviews'));
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
        $validated=$request->validate([
            'product_id'=>'integer|required',
            'rating'=>'integer|min:1|max:5|required',
            'comment'=>'nullable|max:1000'
        ]);

        $review=Review::create([
            'user_id'=>Auth::id(),
            'product_id'=>$validated['product_id'],
            'rating'=>$validated['rating'],
            'comment'=>$validated['comment']
        ]);
        return  redirect()->route('reviews.index')
            ->with('status', 'Thank you for submitting a review');
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
        $product=new ProductResource(Product::findOrFail($id));
        return inertia::render('account.reviews.show', compact('product'));
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
        $review=new ReviewResource(Review::with('product')->findOrFail($id));
        return inertia::render('account.reviews.edit', compact('review'));
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
        $review=Review::findOrFail($id);
        $validated=$request->validate([
            'product_id'=>'integer|required',
            'rating'=>'integer|min:1|max:5|required',
            'comment'=>'nullable|max:1000'
        ]);
        $review->update([
            'rating'=>$validated['rating'],
            'comment'=>$validated['comment']
        ]);
        return  redirect()->route('reviews.index')
            ->with('status', 'Thank you for submitting a review');

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


}
