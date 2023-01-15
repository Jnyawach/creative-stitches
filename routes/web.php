<?php

use App\Http\Controllers\Customer\CustomerCartController;
use App\Http\Controllers\Customer\CustomerDetailsController;
use App\Http\Controllers\Customer\SearchController;
use App\Http\Controllers\General\BlogController;
use App\Http\Controllers\General\ContactUsController;
use App\Http\Controllers\General\HelpCenterConroller;
use App\Http\Controllers\General\PolicyController;
use App\Http\Controllers\General\QuoteController;
use App\Http\Controllers\General\ShopCategoryController;
use App\Http\Controllers\General\ShopController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([], function (){

    Route::resource('/', MainController::class);
});

Route::group([],function(){
    Route::get('search-algolia', [SearchController::class,'index'])->name('search.algolia');
    Route::resource('details', CustomerDetailsController::class)->middleware('guest:web');
    Route::post('enter-promo', [CustomerCartController::class,'enterPromo'])->name('enter.promo');
    Route::patch('move-wishlist/{id}', [CustomerCartController::class,'moveWishlist'])->name('move.wishlist');
    Route::get('cart-get', [CustomerCartController::class,'cartContent']);
    Route::resource('cart', CustomerCartController::class);
    Route::get('shop/promotions/{id}', [ShopController::class,'shopPromotion'])->name('shop.promotion');
    Route::get('shop/category/{id}', [ShopController::class,'shopCategory'])->name('shop.category');
    Route::resource('shop', ShopController::class);
    Route::get('copyright-guidelines', [PolicyController::class, 'copyrightGuideline'])->name('copyright.guidelines');
    Route::get('cookie-policy', [PolicyController::class, 'cookiePolicy'])->name('cookie.policy');
    Route::get('privacy-policy', [PolicyController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('terms-and-condition', [PolicyController::class, 'terms'])->name('terms.conditions');
    Route::resource('custom-embroidery', QuoteController::class);
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('blog',BlogController::class);
    Route::resource('help-center',HelpCenterConroller::class);
});

Route::stripeWebhooks('stripe-webhook');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
