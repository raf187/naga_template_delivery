<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class RestoPAY extends Controller
{
    public function TRupdate($id){
         $TR = Order::findOrFail($id);
         if ((float)\request('trInfo') <= (float)$TR['totalPrice'] - (float)$TR['cbResto']) {
             Order::findOrFail($id)->update([
                 'ticketResto'=>\request('trInfo')
             ]);
         }
        return redirect()->back();
    }

    public function TRdelete($id){
        $TR = Order::findOrFail($id)->update([
            'ticketResto'=>0
        ]);
        return redirect()->back();
    }

    public function CBupdate($id){
        $TR = Order::findOrFail($id);
        if ((float)\request('cbResto') <= (float)$TR['totalPrice'] - (float)$TR['ticketResto']) {
            Order::findOrFail($id)->update([
                'cbResto'=>\request('cbResto')
            ]);
        }
        return redirect()->back();
    }

    public function CBdelete($id){
        $TR = Order::findOrFail($id)->update([
            'cbResto'=>0
        ]);
        return redirect()->back();
    }
}
