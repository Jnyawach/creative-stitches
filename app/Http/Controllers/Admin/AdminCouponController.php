<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons=Coupon::all();
        return inertia::render('admin.coupons.index', compact('coupons'));
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
            'name'=>'required|string|max:255',
            'expires'=>'date|required',
            'discount'=>'integer|required',
            'status'=>'integer|required'
        ]);

        $coupon=Coupon::create([
            'name'=>$validated['name'],
            'expires'=>$validated['expires'],
            'discount'=>$validated['discount'],
            'status'=>$validated['status'],
            'code'=>strtoupper(Str::random(6))
        ]);

        return redirect()->back()
            ->with('status','Coupon Created Successfully');
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
        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'expires'=>'date|required',
            'discount'=>'integer|required',
            'status'=>'integer|required'
        ]);

        $coupon=Coupon::findOrFail($id);
       $coupon->update([
            'name'=>$validated['name'],
            'expires'=>$validated['expires'],
            'discount'=>$validated['discount'],
            'status'=>$validated['status'],

        ]);

        return redirect()->back()
            ->with('status','Coupon Updated Successfully');
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
        $coupon=Coupon::findOrFail($id);
        $coupon->delete();
        return  redirect()->back()
            ->with('status', 'Coupon deleted Successfully');
    }
}
