<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminAuthController extends Controller
{
    //
    public function login(){
        return inertia::render('admin/auth/login');
    }

    public function register(){
        return inertia::render('admin/auth/register');
    }

}
