<?php

use App\Http\Controllers\General\BlogController;
use App\Http\Controllers\General\ContactUsController;
use App\Http\Controllers\General\HelpCenterConroller;
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
    Route::resource('contact-us', ContactUsController::class);
    Route::resource('blog',BlogController::class);
    Route::resource('help-center',HelpCenterConroller::class);
});




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
