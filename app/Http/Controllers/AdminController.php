<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function show(){

        // show the list of admins only
        $admins = User::whereRoleIs(['superadministrator' , 'administrator'])->get();
        return view('admin.listAdmin', compact('admins'));
    }

    public function store(){

        // create a new admin user
        $adminC = User::create([
                'firstName' => \request('adminFirstName'),
                'lastName' => \request('adminLastName'),
                'phone' => \request('adminPhone'),
                'password' => Hash::make(\request('password')),
                'email' => \request('adminEmail'),
                'newsletter'=> 0
            ]);

        // add the level of autorization of the admin to role_user table
        $roleUser = DB::table('role_user')->insert([
            'role_id'=>\request('role_id'),
            'user_id'=>$adminC->id,
            'user_type'=>'App\Models\User'
        ]);

        // creation user session message
        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Admin " .\request('adminFirstName'). "  ajouté"]);
        return redirect('/admin/liste-admin');
    }

    public function updateAdmin($id){

        // show all infos from the admin selected
        $getAdmin = User::findOrFail($id);
        return view('admin.updateAdmin', compact('getAdmin'));
    }

    public function update($id){

        // update the admin user
        $admin = User::findOrFail($id)->update([
            'firstName' => \request('adminFirstName'),
            'lastName' => \request('adminLastName'),
            'phone' => \request('adminPhone'),
            'email' => \request('adminEmail'),
        ]);

        // verify if user have already a role and update
        $user = DB::table('role_user')->where('user_id', $id);
        if ($user){
            $user->delete();
            DB::table('role_user')->insert([
                'role_id'=>\request('role_id'),
                'user_id'=>$id,
                'user_type'=>'App\Models\User'
            ]);
        }else{
             DB::table('role_user')->insert([
                'role_id'=>\request('role_id'),
                'user_id'=>$id,
                 'user_type'=>'App\Models\User'
            ]);
        }

        // update user session message
        \session()->flash('notifSuccess', [
            "type"=>"warning",
            "notif"=>"Admin " .\request('adminFirstName'). " modifié"]);
        return redirect('/admin/liste-admin');
    }

    public function delete($id){

        // delete the admin user from DB
        User::find($id)->delete();
        \session()->flash('notifSuccess', [
            "type"=>"danger",
            "notif"=>"Admin supprimée"]);
        return redirect()->back();
    }
}
