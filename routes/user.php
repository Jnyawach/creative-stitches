<?php

use App\Http\Controllers\Customer\CustomerAccountController;
use Illuminate\Support\Facades\Route;

//All user routes that require authentication will be listed here

Route::group(['middleware'=>'auth:web'], function(){
 Route::resource('account', CustomerAccountController::class);
});
