<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminFaqCategory;
use App\Http\Controllers\Admin\AdminFaqsController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRolesController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AuthorController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['auth:admin']], function (){
    Route::patch('admin/contact/mark-read/{id}', [AdminContactController::class, 'markRead'])->name('contact.markRead');
    Route::resource('admin/contact', AdminContactController::class);
    Route::patch('post-status/{id}',[AdminBlogController::class,'postStatus'])->name('post-status');
    Route::resource('admin/authors', AuthorController::class);
    Route::resource('admin/posts', AdminBlogController::class);
    Route::resource('admin/faqs', AdminFaqsController::class);
    Route::resource('admin/categories', AdminCategoriesController::class);
    Route::resource('admin/faqs-category', AdminFaqCategory::class);
    Route::resource('admin/roles-and-permission/permissions', AdminPermissionController::class);
    Route::resource('admin/roles-and-permission/roles', AdminRolesController::class);
    Route::resource('admin', AdminMainController::class);

});
