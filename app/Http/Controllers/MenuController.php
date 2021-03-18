<?php

namespace App\Http\Controllers;

use App\Models\ExtrasBoll;
use App\Models\Menu;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;


class MenuController extends Controller
{
    public function storeOnDB(Request $request, $id){

        $product = Menu::find($id);
        $extras = ExtrasBoll::find($request->extras);
        if(!$product){
            abort(404);
        }
        $idProd = $product->id . 0 .implode("",$request->extras !== null ? $request->extras : [0]);

        \Cart::session('Cart')->add([
            "id"=>$idProd,
            "name"=>$product->name,
            "price"=>$product->price,
            "quantity"=>1,
            'attributes'=>[
                "prodId"=>$product->id,
                "tva"=>$product->TVA,
                "code"=>$product->code,
                "extra"=>$extras,
            ],
            'associatedModel'=>$product
        ]);

        $cart = \Cart::session('Cart')->getContent();

        if($cart->has($idProd)){
            \Cart::session('Cart')->update($idProd, [
                'quantity' => [
                    'value' => 1
                ]
            ]);
        }
        return redirect()->back();
    }


    public function deleteFromDB($id){
        \Cart::session('Cart')->remove($id);
        return redirect()->back();
    }

    public function incraseFromDB($id){
        \Cart::session('Cart')->update($id,[
            'quantity' => 1
        ]);
        return redirect()->back();
    }

    public function removeFromDB($id){
        \Cart::session('Cart')->update($id,[
            'quantity' => -1
        ]);
        return redirect()->back();
    }

    public function orderJson(){
        $cart = \Cart::session('Cart')->getContent();
        $totalSupp = 0;
        foreach ($cart as $key=>$value){
            $qty = $value['quantity'];
            $extras = $value['attributes']['extra'];
            if ($extras !== null){
                foreach ($extras as $extra) {
                    $price = $extra['price'] === null ? 0 : $extra['price'] * $qty;
                    $totalSupp += floatval($price);
                }
            }
        }
        $subTotal = \Cart::session('Cart')->getTotal();
        $total = $subTotal + $totalSupp;
        $subQty = \Cart::session('Cart')->getTotalQuantity();
        session()->put([
            'subQty'=>$subQty,
            'total'=>$total
        ]);
        return compact('cart', 'subQty', 'total');
    }

    public function offStock(){
      $product = Menu::all();
      return view('admin.settings.offStock', compact('product'));
    }

    public function offStockUpdate($id){
      Menu::findOrFail($id)->update([
        "off_stock"=>\request('offStock')
      ]);
      return redirect()->back(); 
    }
}
