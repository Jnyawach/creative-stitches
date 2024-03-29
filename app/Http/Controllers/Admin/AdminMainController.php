<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Quote;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users=User::count();
        $subscribers=Newsletter::count();
        $products=Product::count();
        $quotes=Quote::where('status','!=',2)->count();
        $messages=Contact::where('status','!=',2)->count();
        $orders=Order::count();
        $income=Payment::sum('total');

        //income last four months
        $chartData=Order::query()->where('created_at','>',Carbon::now()->subMonths(4))
            ->select(DB::raw('count(*) as total, MONTHNAME(created_at) as month'))
            ->groupByRaw('MONTHNAME(created_at)')
            ->get();

//        $chartData=array([
//            'labels'=>$lastFour->pluck('month')->toArray(),
//            'datasets'=>[
//                'data'=>$lastFour->pluck('total')->toArray()
//            ]
//        ]);



        return inertia::render('admin.index',
        compact('users','subscribers','products','quotes',
        'messages','orders','income','chartData'));
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
}
