<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TotalDelivery;
use Illuminate\Http\Request;

class TotalDeliveryController extends Controller
{

    public function show(){
        $totalTR = TotalDelivery::orderBy('deli_date', 'desc')->get();
        return view('admin.deliRevenu', compact('totalTR'));
    }

    public function updateList(){
        $dayOrder = Order::where('deliDate', '>', '2021-03-12')->where('payMethod', 'TR-PAPIER')->get();
        $dayDeli = $dayOrder->groupBy(function ($res, $key){
            return $res->deliDate;
        })->map(function ($itm, $key){
            $total = $itm->where('payMethod', 'TR-PAPIER')->sum('totalPrice');

            return [
                'total_deli'=>$total,
                'deli_day'=>$key
            ];
        });
        foreach ($dayDeli as $value){
            TotalDelivery::where('deli_date', $value['deli_day'])->updateOrCreate([
                "deli_date"=>$value['deli_day'],
                "total_money"=>$value['total_deli']
            ]);
        }
        return redirect('/admin/recettes-livreur');
    }

    public function updateTR($id){
        $deli = TotalDelivery::findOrFail($id);

        if ($deli->total_money >= \request('deliTR')){
            $deli->update(
                [
                    "total_tr"=>\request('deliTR')
                ]);
            \session()->flash('notifSuccess', [
                "type"=>"success",
                "notif"=>"Tickets restaurant ajoutés"]);
        }else{
            \session()->flash('notifSuccess', [
                "type"=>"danger",
                "notif"=>"Tickets restaurant peuvent pas être supérieur au total"]);
        }

        return redirect()->back();
    }

    public function deleteTR($id){
        TotalDelivery::findOrFail($id)->update(
            [
            "total_tr"=>0.00
        ]);
        return redirect()->back();
    }

}
