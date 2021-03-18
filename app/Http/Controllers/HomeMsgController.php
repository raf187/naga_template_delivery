<?php

namespace App\Http\Controllers;

use App\Models\HomeMsg;
use Illuminate\Http\Request;

class HomeMsgController extends Controller
{
    public function homeMsg(){
        $msgInfo = HomeMsg::first();
        return view('admin.settings.homeMsg', compact('msgInfo'));
    }

    public function update($id){
        HomeMsg::findOrFail($id)->update([
            'homeMessage' => \request('homeMessage'),
            'homeMessageTitle' => \request('homeMessageTitle'),
        ]);

        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Message modifié"]);

        return redirect()->back();
    }

    public function updateStatus($id){
        $status = HomeMsg::findOrFail($id);
        $status->update([
            'isActived' => \request('isActived'),
        ]);

        return redirect()->back();
    }

}
