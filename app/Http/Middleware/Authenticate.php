<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use MongoDB\Driver\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
           if ($request->routeIs('admin.*')){
               return route('admin.login');
           }else{

               return  route('login');
           }
        }
        /*
         *
         * if (! $request->expectsJson()) {
            switch ($request) {
                case($request->is('manager/*')):
                    return route('manager.login');
                    break;
                case ($request->is('caretaker/*')):
                    return route('caretaker.login');
                    break;
                case ($request->is('admin/*')):
                    return route('admin.login');
                    break;
                case ($request->is('landlord/*')):
                    return route('landlord.login');
                    break;
                default:
                    return route('tenant.login');
            }
        }

         */
    }
}
