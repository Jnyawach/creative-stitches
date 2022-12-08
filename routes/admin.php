<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRolesController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['auth:admin']], function (){
    Route::resource('roles-and-permission/permissions', AdminPermissionController::class);
    Route::resource('roles-and-permission/roles', AdminRolesController::class);
    Route::resource('admin', AdminMainController::class);

});
