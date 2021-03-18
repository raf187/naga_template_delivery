<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpenTime;

class OpenTimeController extends Controller
{
    public function show(){
      $openTime = OpenTime::all();
      return view('admin.settings.schedules', compact('openTime'));
    }

    public function save(Request $request, $id){

      OpenTime::findOrFail($id)->update([
          'morningOpen'=>\request('morningOpen'),
          'morningClose'=>\request('morningClose'),
          'nightOpen'=>\request('nightOpen'),
          'nightClose'=>\request('nightClose'),
          'morningIsClose'=>$request->has('morningIsClose') ? 1 :0,
          'nigthIsClose'=>$request->has('nigthIsClose') ? 1 :0,
        ]);

        \session()->flash('notifSuccess', [
            "type"=>"success",
            "notif"=>"Horaires mis à jour"]);

        return redirect()->back();
    }
}
