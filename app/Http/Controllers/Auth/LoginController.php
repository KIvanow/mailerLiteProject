<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    }

    protected function authenticated($request, $user)
    {
        // $isAdmin = count(
        //     array_filter(Auth::user()->roles->toArray(), function($v, $k) {
        //         return $v["name"] == "admin";
        //     }, ARRAY_FILTER_USE_BOTH)
        //     ) == 1;
        // if($isAdmin) {
        //     return redirect()->intended('/home');
        // }

        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        // $this->auth->logout();
        \Session::flush();
        return redirect('/');
        // return response()->json(['data' => 'User logged out.'], 200);
    }
}
