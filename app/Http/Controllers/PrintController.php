<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printTicket($id){
        $orderPrint = Order::findOrFail($id);

        $user = User::findOrFail($orderPrint->user_id);
        /*$tva = [
            'tva6' => 0,
            'tva10' => 0,
            'tva20' => 0
        ];
        $cart = $orderPrint->orderList;
        if ($orderPrint->deliSup > 0){
            $tva['tva10'] += $orderPrint->deliSup;
        }
            foreach ($cart as $item){
                if (intval($item['tva']) === 6){
                    $tva['tva6'] += $item['price'] * $item['qty'];
                }
                if (intval($item['tva']) === 10){
                    $tva['tva10'] += $item['price'] * $item['qty'];
                }
                if (intval($item['tva']) === 20){
                    $tva['tva20'] += $item['price'] * $item['qty'];
                }
            }
        $tva['tva6'] = $tva['tva6'] - ($tva['tva6'] / 1.055);
        $tva['tva10'] = $tva['tva10'] - ($tva['tva10'] / 1.1);
        $tva['tva20'] = $tva['tva20'] - ($tva['tva20'] / 1.2);*/

        return view('print.ticket', compact('orderPrint', 'user'));
    }

    public function updateStatus($id){

        Order::findOrFail($id)->update([
            'orderStatus'=>\request('orderStatus')
        ]);

        return redirect('/admin');

}
}
