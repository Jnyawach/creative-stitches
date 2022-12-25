<?php

namespace App\Http\Controllers\General;

use App\Events\QuoteRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return inertia::render('custom-embroidery.index');
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
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'cellphone'=>'required|max:13',
            'email'=>'required|string|max:255|email',
            'attachment'=>'nullable|mimes:pdf,doc,docs,ppt,csv,xlsx|max:2048',
            'description'=>'required|max:1500'
        ]);
        if (!$request->beacon){
            $quote=Quote::create([
                'first_name'=>$validated['first_name'],
                'last_name'=>$validated['last_name'],
                'cellphone'=>$validated['cellphone'],
                'email'=>$validated['email'],
                'description'=>$validated['description']
            ]);

            if($files=$request->attachment){
                $quote->addMedia($files)->toMediaCollection('attachment');
            }
           //send confirmation email
            event(new QuoteRequestEvent($quote));
        }



        return redirect()->back()
            ->with('status','Thank you for your request. Our team will get back shortly');
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
}
