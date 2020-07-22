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
            Route::get('/', 'ProfileController@index')->name('index');
        });
    });
});

