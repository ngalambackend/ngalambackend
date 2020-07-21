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
});

Route::post('/register', 'BackOffice\Auth\RegisterController@store')->name('register.store');
