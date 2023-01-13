<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RegisterUSerRequest;
use App\Mail\PasswordResetMail;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    //

    public function register(RegisterUSerRequest $request){

        $user=User::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
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
        return redirect()->back();
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->back();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }


    public function resetPassword(Request $request){
        $validated=$request->validate([
            'email'=>'required|email|string|exists:users'
        ],[
            'exists'=>'We could not find the provided email in our database'
        ]);

        $user=User::where('email',$validated['email'])->firstOrFail();


        $otp=$user->verifiable()->create([
         'code'=>rand(111111,999999),
            'email'=>$user->email
        ]);

        Mail::to($user)->send(new PasswordResetMail($otp));



    }

    public function updatePassword(Request $request){

        $validate=$request->validate([
            'email'=>'required|email|string|max:255|exists:verifies|exists:users',
            'code'=>'required|digits:6|integer|exists:verifies',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $verify=Verify::where('email',$validate['email'])->where('code',$validate['code'])->latest()->first();

        if (!$verify->status){
            return redirect()->back()
                ->withErrors([
                    'code'=>'The OTP code provided is expired'
                ])->onlyInput('code');
        }
        $user=User::where('email',$validate['email'])->firstOrFail();
        $user->update(['password'=>Hash::make($validate['password'])]);
        $verify->update(['status'=>0]);
        return redirect()->back();
    }
}
