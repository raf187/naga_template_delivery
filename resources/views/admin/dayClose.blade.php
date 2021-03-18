@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-8 offset-md-2 py-4">
            <h4 class="text-center font-weight-bold pb-4">Ajouter un jour de fermeture</h4>
            @if(session()->has('notifSuccess'))
                <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <span>{!! session()->get('notifSuccess.notif') !!}</span>
                </div>
            @endif
        <form action="" method="post">
            @csrf
            <div class="form-group col-md-10 mx-auto my-3">
                <label for="closingDate">Veuillez rentrer une date</label>
                <input type="date" min="<?= date("Y-m-d", strtotime("+ 1 days")) ?>" value="<?= date("Y-m-d", strtotime("+ 1 days")) ?>"
                    value="" class="form-control" name="closingDate"
                    id="closingDate" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Ajoutez votre date au moins 2 jours à l'avance pour
                    eviter tout conflit avec des commandes en cours.</small>
            </div>
            <button type="submit" class="btn btn-success col-md-10 offset-md-1" name="submitClosingDate"
                    id="submitClosingDate">Ajouter date
            </button>
        </form>
        <div class="container py-4 col-md-10 offset-md-1">
            <h5 class="text-center">Jours de fermeture que vous avez ajouté</h5>
            <ul class="list-group border-0 shadow-lg">
                @foreach($dates as $date)
                    <li class="border-bottom-light list-group-item d-flex justify-content-around">
                        {{ \Carbon\Carbon::parse($date->closingDate)->format('d/m/Y') }}
                        <a
                            class="text-danger text-decoration-none deleteLink deleteBtnConfirm"
                            href="/admin/jour-fermeture/{{ $date->id }}"><i class="fas fa-trash pr-3"></i>Effacer</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
@endsection
