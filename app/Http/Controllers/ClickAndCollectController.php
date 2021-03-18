<?php

namespace App\Http\Controllers;

use App\Models\ClickAndCollect;
use Illuminate\Http\Request;

class ClickAndCollectController extends Controller
{

    public function show(){
        $pickTime = ClickAndCollect::orderBy('clickAndCollectTime', 'asc')->get();
        return view('admin.settings.clickAndDeli', compact('pickTime'));
    }

    public function saveTime(){
    ClickAndCollect::create([
        'clickAndCollectTime'=>\request('clickAndCollectTime'),
    ]);
        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Horaire ajouté"]);
        return redirect()->back();
    }

    public function delete($id){
        ClickAndCollect::findOrFail($id)->delete();
        \session()->flash('notifSuccess', [
            "type"=>"danger",
            "notif"=>"Horaire supprimé"]);
        return redirect()->back();
    }
}
