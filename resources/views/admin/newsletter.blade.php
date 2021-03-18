@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-12 py-4">
            <h4 class="text-center font-weight-bold pb-4">Newsletter au clients abonnés</h4>
            @if(session()->has('notifSuccess'))
                <div id="msgSession" class="alertFade col-md-10 mx-auto alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <span>{!! session()->get('notifSuccess.notif') !!}</span>
                </div>
            @endif
            <form class="col-md-10 mx-auto" action="/newsletter" method="post">
                @csrf
                <div class="form-group my-3">
                    <label for="message">Message</label>
                    <textarea class="mailingContent" name="message" id="message"></textarea>
                    <span id="messageHelp" class="text-danger d-none"></span>
                </div>
                <div class="form-group my-3 d-flex justify-content-end">
                    <button type="submit" class="col-12 btn btn-success px-3" name="mailing" id="mailing">Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
