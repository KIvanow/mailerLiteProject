<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->user()->hasRole("admin") ){
            return $this->admin($request);
        } else {
            $request->user()->authorizeRoles(['regular', 'admin']);
            return view('home');
        }
    }


    public function admin(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view('admin');
    }

}
