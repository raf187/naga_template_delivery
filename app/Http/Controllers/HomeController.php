<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PayGreenController\Payment;
use App\Models\ExtrasBoll;
use App\Models\HomeMsg;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OpenTime;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
      //  $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */

    public function menuShow()
    {
      //dd(session()->get('newUserAddress'));
        $orderList = Order::where('paymentStatus',1)->orderBy('created_at', 'desc')->where('user_id', \auth()->id())->limit(10)->get();
        $menuOrder = Menu::all();
        $user = Auth::user();
        $homeMsg = HomeMsg::first();
        $schedules = OpenTime::all();
        $drinks = Menu::where('type', 'drink')->get();
        $bolls = Menu::where('type', 'food')->get();
        $iceCream = Menu::where('type', 'iceCream')->get();
        return view('home', compact('menuOrder', 'orderList', 'bolls', 'drinks', 'iceCream', 'user', 'homeMsg', 'schedules'));
    }


    protected function redirectRouteRole(){
        if (Auth::user()->hasRole('administrator')){
            return redirect('/admin');
        }elseif (Auth::user()->hasRole('superadministrator')){
            return redirect('/admin');
        }else{
            return redirect('/');
        }
    }
}
