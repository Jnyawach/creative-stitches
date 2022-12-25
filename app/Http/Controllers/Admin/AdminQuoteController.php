<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quotes=Quote::query()
            ->when(request('search'),function ($query,$search){
                $query->where('first_name','like', '%'.$search.'%')
                    ->orWhere('last_name','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%');
            })
            ->when(request('status'),function ($query,$status){

                $query->where('status', $status);
            })
            ->latest()->paginate(10);

        $quotes=QuoteResource::collection($quotes);
        $filters=request()->only(['search','status']);

        return inertia::render('admin.quote-request.index', compact('quotes','filters'));
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
        $quote=new QuoteResource(Quote::findOrFail($id));
        return inertia::render('admin.quote-request.show', compact('quote'));
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
        $quote=Quote::findOrFail($id);
        $quote->delete();
        return redirect()->route('quote-request.index')
            ->with('status','Quote successfully deleted');
    }

    public function markResponded($id){
      $quote=Quote::findOrFail($id);
      $quote->update([
          'status'=>2,
          'user_id'=>Auth::id()
      ]);
      return redirect()->back()
          ->with('status','Quote marked as responded');
    }
}
