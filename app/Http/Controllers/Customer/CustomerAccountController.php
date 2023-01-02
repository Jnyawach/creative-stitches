<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Testing\Concerns\Has;

class CustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=new UserResource(User::findOrFail(Auth::id())->load('address'));
        $subscription=Subscription::where('email',$user->email)->first();
        return inertia::render('account.index', compact('user','subscription'));
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
        $validated=$request->validate([
            'name'=>'required|max:255|string|max:50',
            'last_name'=>'required|max:255|string|max:50'
        ]);
        $user=User::findOrFail($id);
        $user->update([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name']
        ]);
        return redirect()->back()
            ->with('status', 'Account info updated Successfully');
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

    public function addressStore(Request $request){

        $validated=$request->validate([
            'user_id'=>'required|integer',
            'country_id'=>'required|integer',
            'address'=>'required|string|max:50',
            'city'=>'required|string|max:50',
            'zip'=>'required|string|max:50'
        ]);

        $address=Address::create([
            'user_id'=>$validated['user_id'],
            'country_id'=>$validated['country_id'],
            'address_1'=>$validated['address'],
            'city'=>$validated['city'],
            'zip'=>$validated['zip']
        ]);
       return redirect()->back()
           ->with('status','Address Saved Successfully');
    }

    public function addressUpdate(Request $request,$id){

        $validated=$request->validate([

            'country_id'=>'required|integer',
            'address'=>'required|string|max:50',
            'city'=>'required|string|max:50',
            'zip'=>'required|string|max:50'
        ]);

        $address=Address::findOrFail($id);
        $address->update([
            'country_id'=>$validated['country_id'],
            'address_1'=>$validated['address'],
            'city'=>$validated['city'],
            'zip'=>$validated['zip']
        ]);
        return redirect()->back()
            ->with('status','Address Updated Successfully');
    }

    public function passwordUpdate(Request $request, $id){
        $validated=$request->validate([
            'current_password'=>'required|string|min:8',
            'password'=>'required|string|min:8|confirmed|different:current_password'
        ],[
            'different'=>'The new password and the current password must be different'
        ]);
        $user=User::findOrFail($id);

        if (!Hash::check($validated['current_password'],$user->password)){
            return redirect()->back()
                ->withErrors([
                    'current_password'=>'Current Password is incorrect'
                ])->onlyInput('current_password');
        }
        $user->update([
            'password'=>Hash::make($validated['password'])
        ]);

        return redirect()->back()
            ->with('status','Password Updated Successfully');
    }

    public function subscriptionDelete($id){
        $subscription=Subscription::findOrFail($id);
        $subscription->delete();
        return redirect()->back()
            ->with('status','Subscription Successfully cancelled');
    }

    public function subscriptionCreate($id){
        $user=User::findOrFail($id);
        $subscription=Subscription::create([
            'name'=>$user->name,
            'email'=>$user->email,
        ]);

        return redirect()->back()
            ->with('status','Subscription Successfully Created');
    }
}
