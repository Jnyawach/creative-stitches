<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return vite()->getHash();
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        if (Auth::user()){
            $auth=[
                'role'=>Auth::user()->getRoleNames()->first(),
                'name'=>Auth::user()->name,
                'last_name'=>Auth::user()->last_name,
                'email'=>Auth::user()->email,
                'id'=>Auth::id()
            ];

        }else{
            $auth=null;
        }
        return array_merge(parent::share($request), [
            'auth' =>$auth,
            'status' => $request->session()->get('status')?$request->session()->get('status'):null,
            'session'=>session()->only(['requireAuth']),
            'cart' => [
                'items' => \Cart::getContent(),
                'cartCount' => \Cart::getTotalQuantity(),
                'cartSubTotal' => \Cart::getSubTotal(),
                'cartTotal' => \Cart::getTotal(),
                ],

        ]);
    }
}
