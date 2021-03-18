@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-8 offset-md-2 py-4">
            <h4 class="text-center font-weight-bold pb-4">Gestion des informations service</h4>
            @if(session()->has('notifSuccess'))
                <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <span>{!! session()->get('notifSuccess.notif') !!}</span>
                </div>
            @endif
                <a href="/admin/ajouter-info" class="btn btn-success col-md-10 offset-md-1">Ajouter une info service
                </a>
            <div class="container py-4 col-md-10 offset-md-1">
                <h5 class="text-center">Toutes les infos</h5>
                <ul class="list-group border-0 shadow-lg">
                        @if(count($infoList) > 0)
                            @foreach($infoList as $info)
                                <li class="border-bottom-light list-group-item d-flex justify-content-between">
                                    <span class="col-4">
                                        {{ $info->title }}
                                    </span>
                                    <span class="col-4">
                                        par {{ $info->author }}
                                    </span>
                                    <div class="col-4 text-center">
                                        <a href="/admin/modifier-info/{{ $info->id }}"><i class="far fa-edit text-success mr-4"></i></a>
                                        <a href="/admin/delete-info/{{$info->id}}" class="text-danger deleteLink deleteBtnConfirm"><i class="fas fa-trash pr-3"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                        <li class="border-bottom-light list-group-item d-flex justify-content-around">
                            Pas de info service dans la base de donnes.
                        </li>
                        @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
