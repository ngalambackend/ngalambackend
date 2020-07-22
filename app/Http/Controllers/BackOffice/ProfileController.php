<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backoffice.profiles.index', [
            'profile'   => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $profile = Admin::findOrFail(Auth::user()->id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:admins,email,'.$profile->id.',id'
        ]);

        $profile->name  = $request->get('name');
        $profile->email = $request->get('email');
        $profile->save();

        alert()->success('Updated Profile Successfull!', 'Updated');
        return redirect()->back();
    }

    public function password()
    {
        return view('backoffice.profiles.password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password'  => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8'
        ]);

        $profile = Admin::findOrFail(Auth::user()->id);

        $profile->password  = Hash::make($request->get('password'));
        $profile->save();

        alert()->success('Password has been changed', 'Reset');
        return redirect()->back();
    }
}
