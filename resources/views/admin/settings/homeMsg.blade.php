@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-10 offset-md-1 py-4">
            <h4 class="text-center font-weight-bold pb-4">Message de info accueil</h4>
            <form method="post" id="homeMsgStatus" action="/admin/home-info-activation/{{$msgInfo->id}}">
                @csrf
                <input type="hidden" id="isActived" name="isActived" value="@if($msgInfo->isActived == 0) 1 @else 0 @endif">
                <button type="submit" class="font-weight-bold btn @if($msgInfo->isActived == 0) btn-success @else btn-danger @endif col-md-10 offset-md-1 py-4">
                    @if($msgInfo->isActived == 0) Afficher le message sur l'acueill du site @else Retirer le message d'acueill du site @endif
                </button>
            </form>
            <hr class="my-5">
            @if(session()->has('notifSuccess'))
                <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <span>{!! session()->get('notifSuccess.notif') !!}</span>
                </div>
            @endif
            <form class="col-md-10 mx-auto" action="/admin/home-info/{{$msgInfo->id}}" method="post">
                @csrf
                <div class="form-group my-3 text-center">
                    <label for="titleInfo">Le titre</label>
                    <input class="col-12" name="homeMessageTitle" id="homeMessageTitle" value="{!! $msgInfo->homeMessageTitle !!}">
                </div>
                <div class="form-group my-3 text-center">
                    <label class="" for="messageInfo">Votre message</label>
                    <textarea class="InfoContent" name="homeMessage" id="homeMessage">{!! $msgInfo->homeMessage !!}</textarea>
                </div>
                <div class="form-group my-3">
                    @if (count($errors) > 0)
                        <div class="chatter-alert alert alert-danger">
                            <div class="container">
                                <p><strong><i class="chatter-alert-danger"></i> {{ Config::get('chatter.alert_messages.danger') }}</strong> Please fix the following errors:</p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="col-12 btn btn-success px-3" name="" id="">Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
