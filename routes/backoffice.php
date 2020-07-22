<?php

use App\Models\UserManagement\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/backoffice', function () {
    $admins = Admin::all();
    if ($admins->count() == 0) {
        return view('backoffice/auth/register');
    } else {
        return view('backoffice/auth/login');
    }
})->name('backoffice');

Route::prefix('backoffice')->name('backoffice.')->namespace('BackOffice')->group(function() {
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::middleware('auth:backoffice')->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');

        /**
         * @todo Profiles
         */
        Route::prefix('profile')->name('profile.')->group(function() {
            Route::put('/reset', 'ProfileController@reset')->name('reset');
            Route::get('/password', 'ProfileController@password')->name('password');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::get('/', 'ProfileController@index')->name('index');
        });

        /**
         * @link Settings
         */
        Route::prefix('setting')->name('setting.')->namespace('Settings')->group(function() {
            /**
             * @todo Admins
             */
            Route::prefix('admin')->name('admin.')->group(function() {
                Route::post('/destroy/{admin_id}', 'AdminController@destroy')->name('destroy');
                Route::post('/update/{admin_id}', 'AdminController@update')->name('update');
                Route::post('/store', 'AdminController@store')->name('store');
                Route::get('/index-json', 'AdminController@indexJson')->name('indexJson');
                Route::get('/', 'AdminController@index')->name('index');
            });
        });
    });
});

