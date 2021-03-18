@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-10 offset-md-1 py-4">
            <h4 class="text-center font-weight-bold pb-4">Click&Collect horaires de retrait</h4>
            <div class="my-3 px-5">
                @if(session()->has('notifSuccess'))
                    <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        <span>{!! session()->get('notifSuccess.notif') !!}</span>
                    </div>
                @endif
                <form method="POST" action="/admim/click&collect-time">
                    @csrf
                    <div class="row d-flex justify-content-center">
                        <label class=" my-auto" for="clickAndCollectTime">Ajouter horaire de retrait</label>
                        <input class="mx-5 my-auto col-md-2" type="time" id="clickAndCollectTime" name="clickAndCollectTime" min="09:00" max="23:00" required>
                        <button class="btn btn-secondary my-auto col-md-2">Ajouter</button>
                    </div>
                </form>
                <hr>
                <div class="container d-flex justify-content-around row mt-4">

                                <div class="col-md-4">
                                    <h6 class="text-center">horaires retrait midi</h6>
                                    <ul class="list-group border-0 shadow-lg">
                                        @foreach($pickTime as $pick)
                                            @if(\Carbon\Carbon::parse($pick->clickAndCollectTime)->format('H:i') < "16:00")
                                            <li class="border-bottom-light list-group-item d-flex justify-content-around">
                                                {{ \Carbon\Carbon::parse($pick->clickAndCollectTime)->format('H:i') }}
                                                <a
                                                    class="text-danger text-decoration-none deleteLink deleteBtnConfirm"
                                                    href="/admim/click&collect-time-delete/{{ $pick->id }}"><i class="fas fa-trash pr-3"></i>Effacer</a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="text-center">horaires retrait soir</h6>
                                    <ul class="list-group border-0 shadow-lg">
                                        @foreach($pickTime as $pick)
                                            @if(\Carbon\Carbon::parse($pick->clickAndCollectTime)->format('H:i') > "16:00")
                                            <li class="border-bottom-light list-group-item d-flex justify-content-around">
                                                {{ \Carbon\Carbon::parse($pick->clickAndCollectTime)->format('H:i') }}
                                                <a
                                                    class="text-danger text-decoration-none deleteLink deleteBtnConfirm"
                                                    href="/admim/click&collect-time-delete/{{ $pick->id }}"><i class="fas fa-trash pr-3"></i>Effacer</a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            <span class="text-muted mt-3">* Heure de retrait et désactivé 15 minutes avant pour laisser le temps de preparation</span>
                            <span class="text-muted">** On conseille d'activer les retraits tous les 15 minutes pour une meilleure gestion des commandes</span>
                </div>
            </div>
        </div>
    </div>
@endsection
