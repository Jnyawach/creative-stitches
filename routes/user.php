<?php

use App\Http\Controllers\Customer\CustomerAccountController;
use Illuminate\Support\Facades\Route;

//All user routes that require authentication will be listed here

Route::group(['middleware'=>'auth:web'], function(){
    Route::patch('account/password-update/{id}', [CustomerAccountController::class,'passwordUpdate'])->name('password.edit');
    Route::patch('account/address-update/{id}', [CustomerAccountController::class,'addressUpdate'])->name('address.update');
    Route::post('account/address-store', [CustomerAccountController::class,'addressStore'])->name('address.store');
    Route::resource('account', CustomerAccountController::class);
});
