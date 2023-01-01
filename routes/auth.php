<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedUser;
use Illuminate\Support\Facades\Route;
use  \App\Http\Controllers\Admin\Auth\AdminAuthController;
use  \App\Http\Controllers\Admin\Auth\AuthenticatedAdmin;

// Auth routes. Customized to fit the application needs
Route::group(['middleware'=>['guest:admin']], function(){
    Route::get('/admin/auth/login',[AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('admin/auth/authenticate',[AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
    Route::get('/admin/auth/register',[AdminAuthController::class, 'register'])->name('admin.register');
    Route::post('/admin/auth/create',[AdminAuthController::class, 'create'])->name('admin.save');

});

Route::group(['middleware'=>['auth:admin']], function (){
    Route::post('/admin/auth/logout',[AuthenticatedAdmin::class, 'destroy'])->name('admin.logout');
});

//User/Client login

Route::group([], function (){
    Route::post('/auth/update-password',[AuthController::class, 'updatePassword'])->name('update.password');
    Route::post('/auth/request-reset',[AuthController::class, 'resetPassword'])->name('reset.password');
    Route::post('register',[AuthController::class, 'register'])->name('save.user');
    Route::post('/auth/authenticate',[AuthController::class, 'authenticate'])->name('user.authenticate');
});

Route::group(['middleware'=>['auth:web','guest:admin']], function (){
    Route::post('/auth/logout',[AuthenticatedUser::class, 'destroy'])->name('user.logout');
});
