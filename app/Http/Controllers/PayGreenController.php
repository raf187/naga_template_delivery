<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
use App\Models\Order;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PaygreenApiClient\ApiClient;
use App\Http\Controllers\PayGreenController\Payment;

class PayGreenController extends Controller
{

    /**
     * @var ApiClient
     */
    private ApiClient $client;

    public function storeOnline($pid){
        $order = Order::updateOrCreate([
            "orderId"=>session('orderList.orderIdNaga'),
        ],[
            "user_id"=>session('orderList.user_id'),
            "orderId"=>session('orderList.orderIdNaga'),
            "orderList"=>session('orderList.orderList'),
            "payMethod"=>session('orderList.payMethod'),
            "utensils"=>session('orderList.utensils'),
            "totalPrice"=>session('orderList.total'),
            "tva6"=>session('orderList.tva.tva6'),
            "tva10"=>session('orderList.tva.tva10'),
            "tva20"=>session('orderList.tva.tva20'),
            "deliTime"=>session('orderList.deliTime'),
            "deliDate"=>session('orderList.deliDate'),
            "deliType"=>session('orderList.deliType'),
            "paygreenID"=> $pid
        ]);

    }

    public function payGreenGenerate($payType)
   {
       $paygreen = new Payment(env('PAYGREEN_UI'), env('PAYGREEN_CP'), env('PAYGREEN_HOST'));
       try {

           $orderId = session('orderList.orderIdNaga');
           $nom = Str::slug(Auth::user()->firstName);
           $prenon = Str::slug(Auth::user()->lastName);
           $userId = Str::slug(Auth::id());
           $userMail = Auth::user()->email;
           $totalCents = intval((session('orderList.total') * 100));
           $resp = $paygreen->createInstantPayment(
               $orderId,
               $totalCents,
               $payType,
               "http://naga-sophia.test/pay-return",
               [
                   "id" => $userId,
                   "lastName" => $nom,
                   "firstName" => $prenon,
                   "email" => $userMail,
                   "country" => "FR",
               ],
               "http://naga-sophia.test/ordersNotComfirmed",
           );
           if ($resp->success) {
               $this->storeOnline($resp->data->id);
               session()->put('pid', $resp->data->id);
               session()->put('orderId', $orderId);

               return  redirect($resp->data->url);
           }
       } catch (RequestException $e) {
           $req = $e->getRequest();
           if ($e->hasResponse()) {
               $resp = $e->getResponse();
           }
           Mail::to("contact@rawd.net")->send(var_dump($resp));
           return redirect('/');
       }
   }

   public function updateStatus(){
       $orderNotComfirmed = Order::join('users','orders.user_id','users.id')
           ->where('paymentStatus',0)
           ->select('users.*', 'orders.*')
           ->get();
       $orderMail = "";
       $orderList = "";
       $paygreen = new Payment(env('PAYGREEN_UI'), env('PAYGREEN_CP'), env('PAYGREEN_HOST'));
       foreach ($orderNotComfirmed as $order){
           $deleteDate = date('Y/m/d', strtotime("- 1 days"));
           $created = date('Y/m/d', strtotime($order->created_at));
           if ($created < $deleteDate){
               $order->delete();
           }
           if (!empty($order['paygreenID']) || $order['paygreenID'] !== NULL){
               $resp = $paygreen->confirmPayment($order['paygreenID']);
               if ($resp->result->status === "SUCCESSED"){
                   $order->update([
                       "paymentStatus"=>1
                   ]);
                   foreach ($order->orderList as $item){
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
                   $deliSup = $order->deliSup > 0 ? "<tr><td>Supplément livraison</td><td style='padding-left: 60px'>2,50 €</td></tr>" : "";

                   $mailTva6 = $order->tva6 > 0 ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 5.5% ". number_format($order->tva6, 2, ",", ".") . " €</td>
                        </tr>" : "";
                   $mailTva10 = $order->tva10 > 0 ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 10% ". number_format($order->tva10, 2, ",", ".") . " €</td>
                        </tr>" : "";
                   $mailTva20 = $order->tva20 ? "<tr style='font-size: 11px;'>
                            <td></td>
                            <td style='padding-left: 60px'>TVA 20% ". number_format($order->tva20, 2, ",", ".") . " €</td>
                        </tr>" :"";

                   $totalHT = $order->totalPrice - $order->tva6 - $order->tva10 - $order->tva20;
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
                        <td style='padding-left: 60px;'>Total TTC : ". number_format($order->totalPrice, 2, ",", ".") . " €</td>
                    </tr>
                   $mailTva6
                   $mailTva10
                   $mailTva20
                   $HT
            </table>";

                   $content = [
                       "restName"=>"Nâga Sophia",
                       "hello"=>"Bonjour!",
                       "body1"=>"Votre commande n°" . $order->orderId . " a bien été enregistrée, ci-joint un récapitulatif de votre commande.<hr>",
                       "body2"=>$orderArray,
                       "body3"=>"<hr>". $order->deliType ." prévue le ". date('d/m/Y', strtotime($order->deliDate)) . " à " . str_replace(":", "h",$order->deliTime) . ".",
                       "thanks"=>"À trés bientôt l'equipe Nâga"
                   ];
                   Mail::to($order->email)->send(new ConfirmOrder($content));
               }
           }

       }
   }


   public function payGreenVerify(){
           $paygreen = new Payment(env('PAYGREEN_UI'), env('PAYGREEN_CP'), env('PAYGREEN_HOST'));
           $pid = session("pid");
           $orderId = session("orderId");
       if ($pid) {
               $resp = $paygreen->confirmPayment($pid);
               if ($resp) {
                   if ($resp->result->status === "SUCCESSED") {
                       \session()->flash('notifSuccess', [
                           "type" => "success",
                           "notif" => "PAIEMENT ACCEPTÉ<br>Votre commande n° " . session('orderList.orderIdNaga') . " à bien été enregistré,
                                        <a class='' href='' data-toggle='modal' data-target='#userOrders'>
                                        consulter mes commandes.</a><br>
                                        L'équipe Nâga vous remercie et vous souhaite un bon appétit"
                       ]);
                       \session()->forget(['cart', 'orderList', 'pid', 'userMail']);
                       \Cart::session('Cart')->clear();
                       return redirect('/');
                   } else if($resp->result->status === "REFUSED"){
                       \session()->flash('notifSuccess', [
                           "type" => "danger",
                           "notif" => "Paiment refusée, merci de réessayer!"]);
                       return redirect('/');
                   }else {
                   \session()->flash('notifSuccess', [
                       "type" => "warning",
                       "notif" => "Votre paiement à pas été finalisé, merci de réessayer!"]);
                   return redirect('/');
                 }
               }
           }else {
           \session()->flash('notifSuccess', [
               "type" => "warning",
               "notif" => "Votre paiement à pas été finalisé, merci de réessayer!"]);
           return redirect('/');
       }
    }

    public function payOrderCash(){
        $this->storeOnline(null);
        Order::where("orderId",session('orderList.orderIdNaga'))->update([
            "paymentStatus"=>1
        ]);
        \session()->flash('notifSuccess', [
            "type" => "success",
            "notif" => "COMMANDE ENREGISTRÉ<br>Votre commande n° ".session('orderList.orderIdNaga'). " à bien été prise en compte,
                                        <a class='' href='' data-toggle='modal' data-target='#userOrders'>
                                        consulter mes commandes.</a><br>
                                        L'équipe Nâga vous remercie et vous souhaite un bon appétit"
        ]);
        \session()->forget(['cart', 'orderList', 'pid']);
        \Cart::session('Cart')->clear();
        return redirect('/');
    }

}
