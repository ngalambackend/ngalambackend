<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    /**
     * Max login attempts allowed.
     */
    public $maxAttempts = 5;

    /**
     * Number of minutes to lock the login.
     */
    public $decayMinutes = 3;

    public function __construct() {
        $this->middleware('guest:backoffice')->except('logout');
    }

    /**
     * Register a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:admins,email',
            'password'  => 'required',
            'password_confirmation' => 'required|same:password|min:8'
        ]);

        $admin  = new Admin();

        $admin->name            = $request->name;
        $admin->email           = $request->email;
        $admin->remember_token  = Str::random(60);
        $admin->password        = Hash::make($request->password_confirmation);
        $admin->save();

        alert()->success('Yay! Now you can login to the system', 'Registered');
        return redirect()->back();
    }

    public function login(Request $request)
    {
        // \Log::info('message : ', ['info', $request->all()]); //for debug
        $this->validator($request);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        //attempt login
        if (Auth::guard('backoffice')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //Authenticated Passed
            return redirect()->intended(route('backoffice.home'))->with('success', 'Welcome my friend');
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authenticated Failed
        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('backoffice')->logout();
        alert()->success('You have been log out from the system', 'Log Out');
        return redirect()->route('backoffice');
    }

    public function validator(Request $request)
    {
        $rules  = [
            'email'     => 'required',
            'password'  => 'required'
        ];

        $message    = [
            'email.exists'   => 'This credential does not match our database',
        ];

        $request->validate($rules, $message);
    }

    public function loginFailed()
    {
        alert()->warning('Failed Login. Please, Try again', 'Fail');
        return redirect()->back()->withInput();
    }

    public function username()
    {
        return 'email';
    }
}
