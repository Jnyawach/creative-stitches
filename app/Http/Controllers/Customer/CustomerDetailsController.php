<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUSerRequest;
use App\Models\Newsletter;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class CustomerDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return inertia::render('details.index');
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
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user=User::create([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);
        $role=Role::find(2);
        $user->assignRole($role);
        $stripeCustomer = $user->createAsStripeCustomer();
        if ($request->subscribe){
            if (!$email=Newsletter::where('email',$user->email)->first()){
                $subscriber=Newsletter::create([
                    'email'=>$user->email,
                    'name'=>$user->name
                ]);
            }
        }
        Auth::login($user);
        return  redirect()->route('payment.index');


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

    public function subscribe(Request $request){
        $validated=$request->validate([
            'name'=>'required|max:50|string',
            'email'=>'required|email|string|max:60'
        ]);
        if (!$email=Newsletter::where('email',$validated['email'])->first()){
            $subscriber=Newsletter::create([
                'email'=>$validated['email'],
                'name'=>$validated['name']
            ]);

            return redirect()->back()
                ->with('status','You have successfully subscribed to our Newsletter');
        }
        return redirect()->back()
            ->with('status','An active subscription exists under the same email');
    }
}
