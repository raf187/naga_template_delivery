<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TotalDelivery;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function show(){
        $array = [];
        $dayOrder = Order::all()->where('paymentStatus',1)->sortBy('deliDate');

        $day = $dayOrder->groupBy(function ($res, $key){
           return $res->deliDate;
        })->map(function ($itm, $key){
            $totalCBresto = $itm->sum('cbResto');
            //$totalMoneyResto = $itm->where('payMethod', 'ESPÈCES')->sum('totalPrice');
            $total = $itm->sum('totalPrice');
            $totalPG = $itm->whereNotIn('payMethod', ['TR-PAPIER','ESPÈCES'])->sum('totalPrice');
            $totalTRresto = $itm->where('payMethod', 'ESPÈCES')->sum('ticketResto');
            $totalTRbefore = $itm->where('deliDate', '<', '2021-03-14')->where('payMethod', 'TR-PAPIER')->sum('ticketResto');
            $totalMoney = ($total - $totalCBresto - $totalTRresto - $totalTRbefore - $totalPG);
            $tva6 = $itm->sum('tva6');
            $tva10 = $itm->sum('tva10') + ($itm->sum('deliSup') - ($itm->sum('deliSup') / 1.1));
            $tva20 = $itm->sum('tva20');
            $totalDeli = TotalDelivery::where('deli_date', $key)->first();
            if ($totalDeli){
                return [
                    'totalCBresto'=>$totalCBresto,
                    'totalTR'=>$totalTRresto + $totalDeli->total_tr,
                    'totalMoney'=>$totalMoney - $totalDeli->total_tr,
                    'totalPG'=>$totalPG,
                    'tva6'=>$tva6,
                    'tva10'=>$tva10,
                    'tva20'=>$tva20,
                    'totalHT'=>$total - $tva6 - $tva10 - $tva20,
                    'totalTTC'=>$total
                ];
            }else{
                return [
                    'totalCBresto'=>$totalCBresto,
                    'totalTR'=>$totalTRresto + $totalTRbefore,
                    'totalMoney'=>$totalMoney,
                    'totalPG'=>$totalPG,
                    'tva6'=>$tva6,
                    'tva10'=>$tva10,
                    'tva20'=>$tva20,
                    'totalHT'=>$total - $tva6 - $tva10 - $tva20,
                    'totalTTC'=>$total
                ];
            }
        });
        $totalDeli = TotalDelivery::all();
        return view('admin.revenue', compact('day','totalDeli'));
    }
}
