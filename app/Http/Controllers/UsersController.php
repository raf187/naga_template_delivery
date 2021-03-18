<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function show(){
        $customers = User::whereRoleIs('user')->get();

        return view('admin.customers', compact('customers'));
    }

    public function userShow($id){
        $customer = User::findOrFail($id);

        return view('admin.client', compact('customer'));
    }

    public function updateCust(Request $request, $id){
        $customerInfo = User::findOrFail($id);
        $customer = User::findOrFail($id)->update([
            'deliInfo'=>$request->input("updateDeliInfo"),
            'adminInfo'=>$request->input("adminInfo")
        ]);
        \session()->flash('notifSuccess', [
            "type"=>"warning",
            "notif"=>"Client " . $customerInfo->firstName . " modifié"]);
        return redirect('/admin/clients');
    }

    public function updateUser(){
        $userUpdate = User::findOrFail(Auth::id())->update([
            'firstName' => \request('updateFirstName'),
            'lastName' => \request('updateLastName'),
            'phone' => \request('updatePhone'),
            'address' => \request('addressVerified'),
            'deliInfo' => \request('updateDeliInfo'),
            'email' => \request('updateEmail'),
            'deliRayon' => \request('updateAdressVal'),
            'newsletter' => \request('newsletter')
        ]);

        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Vos infos ont bien été mises à jour"]);
        return redirect()->back();
    }

    public function userAdress(){
      session()->put('newUserAddress', \request('addressVerified'));
    }
}
