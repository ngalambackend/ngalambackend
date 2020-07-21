<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('backoffice.home');
    }
}
