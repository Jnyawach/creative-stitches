<?php

use App\Http\Controllers\Customer\CustomerAccountController;
use App\Http\Controllers\Customer\CustomerPaymentController;
use App\Http\Controllers\Customer\CustomerReviewController;
use App\Http\Controllers\Customer\CustomerWishlistController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

//All user routes that require authentication will be listed here

Route::group(['middleware'=>'auth:web'], function(){
    Route::resource('account/reviews', CustomerReviewController::class);
    Route::resource('account/orders', OrderController::class);
    Route::get('account/payment/unsuccessful', [CustomerPaymentController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('account/payment/success', [CustomerPaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::resource('account/payment', CustomerPaymentController::class);
    Route::resource('account/wishlist', CustomerWishlistController::class);
    Route::patch('account/subscription-create/{id}', [CustomerAccountController::class,'subscriptionCreate'])->name('subscription.create');
    Route::delete('account/subscription-cancel/{id}', [CustomerAccountController::class,'subscriptionDelete'])->name('subscription.cancel');
    Route::patch('account/password-update/{id}', [CustomerAccountController::class,'passwordUpdate'])->name('password.edit');
    Route::patch('account/address-update/{id}', [CustomerAccountController::class,'addressUpdate'])->name('address.update');
    Route::post('account/address-store', [CustomerAccountController::class,'addressStore'])->name('address.store');
    Route::resource('account', CustomerAccountController::class);
});


