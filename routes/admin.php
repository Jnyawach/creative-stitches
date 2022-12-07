<?php

use App\Http\Controllers\Admin\AdminMainController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['auth:admin']], function (){
    Route::resource('admin', AdminMainController::class);
});
