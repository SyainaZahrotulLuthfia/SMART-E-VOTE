<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;




    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            //ketika user hak akses admin maka di arahkan ke route admin dashboard
            return redirect()->route('admin.dashboard');
        }elseif ($user->hasRole('student')) {
            //ketika user hak akses student maka di arahkan ke route student dashboard
            return redirect()->route('student.dashboard');
        }else {
            //ketika bukan user / student maka kita arahkan ke halaman awal
            return redirect()->route('auth.login');
        }
    }
}
