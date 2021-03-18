<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function homeOrder(){
        $dayOrders = Order::join('users','orders.user_id','users.id')
            ->where('paymentStatus',1)
            ->where('deliDate','=',date('Y-m-d'))
            ->select('users.*', 'orders.*')
            ->orderBy('deliTime', 'desc')
            ->get();
        return view('admin.home',compact('dayOrders'));
    }
}
