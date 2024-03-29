<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Customer\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get/categories',[ApiController::class, 'getCategories']);
Route::get('get/posts',[ApiController::class, 'getPosts']);
Route::get('get/coupon',[ApiController::class, 'getCoupon']);
Route::get('get/country',[ApiController::class, 'getCountry']);
Route::get('product/search',[SearchController::class,'index']);

