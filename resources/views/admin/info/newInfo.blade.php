@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-12 py-4">
            <h4 class="text-center font-weight-bold pb-4">Nouvelle info service</h4>
            <form class="col-md-10 mx-auto" action="/admin/ajouter-info" method="post">
                @csrf
                <div class="form-group my-3 text-center">
                    <label for="titleInfo">Ajoutez un titre</label>
                    <input class="col-12" name="titleInfo" id="titleInfo">
                </div>
                <div class="form-group my-3 text-center">
                    <label class="" for="messageInfo">Contenu</label>
                    <textarea class="InfoContent" name="messageInfo" id="messageInfo"></textarea>
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
                    <button type="submit" class="col-12 btn btn-success px-3" name="" id="">Comfirmer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
