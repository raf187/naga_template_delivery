@extends('layouts.admin')
@section('adminContent')
<div class="p-5">
    <div class="border-0 shadow-lg bg-light rounded py-4">
        <h4 class="text-center font-weight-bold pb-4">Horaires de ouverture midi et soir</h4>
        @if(session()->has('notifSuccess'))
            <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                <span>{!! session()->get('notifSuccess.notif') !!}</span>
            </div>
        @endif
        <div class="col-md-10 offset-md-1 mx-auto">
          @foreach($openTime as $time)
            <form action="/admin/schedules/{{$time->id}}" method="post">
              @csrf
              <div class="mb-2">
                  <p class="font-weight-bold">{{$time->dayFr}}</p>
                  <div class="row justify-content-around">
                      <div class="col-md-5 p-3 rounded @if($time->morningIsClose == 1) bg-danger @endif">
                          <label class="px-2 my-auto font-weight-normal">Midi</label>
                          <input name="morningOpen" class="mr-2 my-auto" type="time" value="{{ date("H:i", strtotime($time->morningOpen)) }}">
                          <input name="morningClose" class="ml-2 my-auto" type="time" value="{{ date("H:i", strtotime($time->morningClose)) }}">
                          <div class="text-center pt-2">
                              <input name="morningIsClose" class="mr-2 my-auto" type="checkbox" @if($time->morningIsClose == 1) checked @endif>
                              <label class="my-auto">Fermé</label>
                          </div>
                      </div>
                      <div class="col-md-5 p-3 rounded @if($time->nigthIsClose == 1) bg-danger @endif">
                          <label class="px-2 my-auto font-weight-normal">Soir</label>
                          <input name="nightOpen" class="mr-2 my-auto" type="time" value="{{ date("H:i", strtotime($time->nightOpen)) }}">
                          <input name="nightClose" class="ml-2 mr-3 my-auto" type="time" value="{{ date("H:i", strtotime($time->nightClose)) }}">
                          <div class="text-center pt-2">
                              <input name="nigthIsClose"class="mr-2 my-auto" type="checkbox" @if($time->nigthIsClose == 1) checked @endif>
                              <label class="my-auto">Fermé</label>
                          </div>
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-outline-success px-2" type="submit">Modifier</button>
                      </div>
                  </div>
              </div>
              <hr>
            </form>
          @endforeach
              <p class="text-muted">* Si <span class="text-danger">ROUGE</span> la fermeture et activé</p>
        </div>
    </div>
</div>
@endsection
