<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\MembershipOrder;
use Illuminate\Http\Request;
use Auth;
use Session;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'buyer' || Auth::user()->role == 'supplier')) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                Session::flush();
                return redirect()->route('thankyou');
            } else {
                return redirect()->intended($request->query('redirect', 'dashboard'));
            }
        } else {
            return redirect('login');
        }
    }
}
