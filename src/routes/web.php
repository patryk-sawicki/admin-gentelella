<?php

Route::group(['middleware' => ['admin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/login', 'LiteCode\AdminGentelella\App\Http\Controllers\Backend\Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'LiteCode\AdminGentelella\App\Http\Controllers\Backend\Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::post('/logout', 'LiteCode\AdminGentelella\App\Http\Controllers\Backend\Auth\AdminLoginController@logout')->name('admin.logout');

//        Route::post('/password/email', '\App\Http\Controllers\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
//        Route::get('/password/reset', '\App\Http\Controllers\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
//        Route::post('/password/reset', '\App\Http\Controllers\Auth\AdminResetPasswordController@reset');
//        Route::get('/password/reset/{token}', '\App\Http\Controllers\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

        Route::get('/', 'LiteCode\AdminGentelella\App\Http\Controllers\Backend\AdminController@dashboard')->name('admin.dashboard');

//        Route::group(['middleware' => ['role:Super Admin,Admin']], function() {
            Route::resource('roles','LiteCode\AdminGentelella\App\Http\Controllers\Backend\RoleController',['as'=>'admin']);
//        });
        Route::resource('admins','LiteCode\AdminGentelella\App\Http\Controllers\Backend\AdminUserController',['as'=>'admin']);
//
    });

});