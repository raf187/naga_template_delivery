<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function show(Order $order){


    }

    public function orderSession(){
        $myCart = \Cart::session('Cart')->getContent();
        $subQty = session('subQty');
        $total = session('total');
        $tva6 = 0;
        $tva10 = 0;
        $tva20 = 0;
        $sup = \request('deliSup');
        foreach ($myCart as $ind=>$value){
            $extPrice = 0;
            $qty = $value['quantity'];
            $price = $value['price'];
            $extras = $value['attributes']['extra'];
            $tax = $value['attributes']['tva'];
            if ($extras !== null){
                foreach ($extras as $extra){
                    $extPrice += $extra['price'] === null ? 0 : $extra['price'];

                }
            }
            if (intval($tax) === 6){
                $tva6 += ($price * $qty);
            }
            if (intval($tax) === 10){
                $tva10 += ($price + $extPrice) * $qty ;
            }
            if (intval($tax) === 20){
                $tva20 += ($price * $qty);
            }
        }
        $tva6 = $tva6 - ($tva6 / 1.055);
        $tva10 = $tva10 - ($tva10 / 1.1);
        $tva20 = $tva20 - ($tva20 / 1.2);

        if($sup > "0"){
            $tva10 += 0.27;
        }
        $orderList = [
            "user_id"=>Auth::id(),
            "orderIdNaga"=>\request("orderId"),
            "orderList"=>\Cart::session('Cart')->getContent(),
            "utensils"=>\request("utensils"),
            "payMethod"=>\request("payMethod"),
            //"infoOrder"=>\request("infoOrder"),
            "deliTime"=>\request("deliTime"),
            "deliDate"=>\request("deliDateInp"),
            "deliSup"=>$sup,
            "deliType"=>\request('deliType'),
            "tva"=>[
                "tva6"=>$tva6,
                "tva10"=>$tva10,
                "tva20"=>$tva20
            ],
            'total'=>floatval($total + $sup ),
        ];
        session()->put('orderList', $orderList);

        return compact('orderList');
    }


    public function confirmOrder(){
        $orderSession = session('orderList.orderList');
        $orderMail = "";
        $orderList = "";
        foreach ($orderSession as $item){
            $extras = $item['attributes']['extra'];
            $qty = $item['quantity'];
            $orderList .= "<tr><td>" . $qty . " x " . $item['name'] .  "</td>
                            <td style='padding-left: 60px'>" . number_format($qty * $item['price'], 2, ",", ".") . " €</td></tr>" .  $orderExtra = "";
            if ($extras !== null) {
                foreach ($extras as $extra) {
                    $orderExtra .= "<tr style='margin-left: 30px; font-size: 12px'><td>" . $qty . " x " . $extra['name'] . "</td>
                            <td style='padding-left: 60px'>" . number_format($extra['price'] > 0 ? $qty * $extra['price'] : 0, 2, ",", ".") . " €</td></tr>";
                }
            }
            $orderList .= $orderExtra;
        }
        $orderMail.= $orderList;
        $deliSup = session('orderList.deliSup') > 0 ? "<tr><td>Supplément livraison</td><td style='padding-left: 60px'>2,50 €</td></tr>" : "";

        $mailTva6 = session('orderList.tva.tva6') > 0 ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 5.5% ". number_format(session('orderList.tva.tva6'), 2, ",", ".") . " €</td>
                        </tr>" : "";
        $mailTva10 = session('orderList.tva.tva10') > 0 ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 10% ". number_format(session('orderList.tva.tva10'), 2, ",", ".") . " €</td>
                        </tr>" : "";
        $mailTva20 = session('orderList.tva.tva20') ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 20% ". number_format(session('orderList.tva.tva20'), 2, ",", ".") . " €</td>
                        </tr>" :"";

        $totalHT = session('orderList.total') - session('orderList.tva.tva6') - session('orderList.tva.tva10') - session('orderList.tva.tva20');
        $HT = "<tr style='font-size: 12px;''>
                    <td></td>
                    <td style='padding-left: 60px;'>Total HT : ". number_format($totalHT, 2, ",", ".") . " €</td>
               </tr>";
        $orderArray =
            "<table>
                   $orderMail
                   $deliSup
                   <tr>
                        <td></td>
                        <td style='padding-left: 60px;'>Total TTC : ". number_format(session('orderList.total'), 2, ",", ".") . " €</td>
                    </tr>
                   $mailTva6
                   $mailTva10
                   $mailTva20
                   $HT
            </table>";

        $content = [
            "restName"=>"Nâga Sophia",
            "hello"=>"Bonjour!",
            "body1"=>"Votre commande n°" . session('orderList.orderIdNaga') . " a bien été enregistrée, ci-joint un récapitulatif de votre commande.<hr>",
            "body2"=>$orderArray,
            "body3"=>"<hr>". session('orderList.deliType') ." prévue le ". date('d/m/Y', strtotime(session('orderList.deliDate'))) . " à " . str_replace(":", "h",session('orderList.deliTime')) . ".",
            "thanks"=>"À trés bientôt l'equipe Nâga"
        ];
        Mail::to(Auth::user()->email)->send(new ConfirmOrder($content));
    }

    public function dayOrder(){
        $todayOrders = Order::join('users','orders.user_id','users.id')
            ->where('paymentStatus',1)
            ->where('deliDate','=',date('Y-m-d'))
            ->select('users.*', 'orders.*')
            ->orderBy('deliTime', 'desc')
            ->get();
        return view('admin.dayOrder', compact('todayOrders'));
    }

    public function futureOrder(Request $request){
        $futuresOrders = Order::join('users','orders.user_id','users.id')
            ->where('paymentStatus',1)
            ->where('deliDate','>',date('Y-m-d'))
            ->select('users.*', 'orders.*')
            ->orderBy('deliTime', 'desc')
            ->get();
        $menuOrder = Menu::all();
        return view('admin.futureOrder', compact('futuresOrders', 'menuOrder'));
    }

    public function oldOrder(){
        $oldOrders = Order::join('users','orders.user_id','users.id')
            ->where('paymentStatus',1)
            ->where('deliDate','<',date('Y-m-d'))
            ->select('users.*', 'orders.*')
            ->orderBy('deliTime', 'desc')
            ->get();
        return view('admin.oldOrder', compact('oldOrders'));
    }

    public function dayOrderAjax(){
        $order = Order::where('paymentStatus',1)->where('deliDate','=',date('Y-m-d'))->orderBy('deliDate', 'desc')->orderBy('deliTime', 'desc')->get();

        return compact('order');
    }

    public function updateStatus($id){
        Order::findOrFail($id)->update([
            "orderStatus"=>1
        ]);
        return redirect()->back();
    }

    public function updatepayMethod($id){
        Order::findOrFail($id)->update([
            "payMethod"=>\request('updPayMethod')
        ]);
        return redirect()->back();
    }

    public function deleteOrder($id){
        Order::findOrFail($id)->delete();

        \session()->flash('notifSuccess', [
            "type" => "danger",
            "notif" => "Commande supprimée"]);
        return redirect()->back();
    }

}
