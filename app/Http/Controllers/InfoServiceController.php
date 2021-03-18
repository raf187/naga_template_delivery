<?php

namespace App\Http\Controllers;


use App\Models\InfoService;
use Illuminate\Support\Facades\Auth;

class InfoServiceController extends Controller
{
    public function showList(){
        $infoList = InfoService::all();
        return view('admin.info.infoService', compact('infoList'));
    }

    public function show(){
        $infoList = InfoService::all();
        return view('admin.info.info', compact('infoList'));
    }


    public function store(){
        $validation = \request()->validate([
            'titleInfo'=>'required|min:4|max:255',
            'messageInfo'=>'required'
        ]);

        InfoService::create([
            'title'=>$validation['titleInfo'],
            'content'=>$validation['messageInfo'],
            'author'=>Auth::user()->firstName
        ]);

        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Nouvelle info service ajouté"]);
        return redirect('/admin/service-liste');
    }

    public function updateInfo($id){
       $updateInfo = InfoService::findOrFail($id);
       //dd($updateInfo);
       return view('admin.info.updateInfo', compact('updateInfo'));

    }

    public function update($id){
        $validation = \request()->validate([
            'titleInfo'=>'required|min:4|max:255',
            'messageInfo'=>'required'
        ]);

        InfoService::findOrFail($id)->update([
            'title'=>$validation['titleInfo'],
            'content'=>$validation['messageInfo'],
            'author'=>Auth::user()->firstName
        ]);

        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Info service mise à jour"]);
        return redirect('/admin/service-liste');
    }

    public function delete($id){
        InfoService::find($id)->delete();
        \session()->flash('notifSuccess', [
            "type"=>"danger",
            "notif"=>"Info supprimée"]);
        return redirect()->back();
    }
}
