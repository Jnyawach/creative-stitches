<?php

use App\Http\Controllers\Customer\CustomerAccountController;
use App\Http\Controllers\Customer\CustomerWishlistController;
use Illuminate\Support\Facades\Route;

//All user routes that require authentication will be listed here

Route::group(['middleware'=>'auth:web'], function(){
    Route::resource('account/wishlist', CustomerWishlistController::class);
    Route::patch('account/subscription-create/{id}', [CustomerAccountController::class,'subscriptionCreate'])->name('subscription.create');
    Route::delete('account/subscription-cancel/{id}', [CustomerAccountController::class,'subscriptionDelete'])->name('subscription.cancel');
    Route::patch('account/password-update/{id}', [CustomerAccountController::class,'passwordUpdate'])->name('password.edit');
    Route::patch('account/address-update/{id}', [CustomerAccountController::class,'addressUpdate'])->name('address.update');
    Route::post('account/address-store', [CustomerAccountController::class,'addressStore'])->name('address.store');
    Route::resource('account', CustomerAccountController::class);
});


