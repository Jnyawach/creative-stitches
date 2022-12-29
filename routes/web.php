<?php

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
    Route::resource('shop-category', ShopCategoryController::class);
    Route::resource('shop', ShopController::class);
    Route::resource('/', MainController::class);
});

Route::group([],function(){
    Route::get('copyright-guidelines', [PolicyController::class, 'copyrightGuideline'])->name('copyright.guidelines');
    Route::get('cookie-policy', [PolicyController::class, 'cookiePolicy'])->name('cookie.policy');
    Route::get('privacy-policy', [PolicyController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('terms-and-condition', [PolicyController::class, 'terms'])->name('terms.conditions');
    Route::resource('custom-embroidery', QuoteController::class);
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('blog',BlogController::class);
    Route::resource('help-center',HelpCenterConroller::class);
});




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
