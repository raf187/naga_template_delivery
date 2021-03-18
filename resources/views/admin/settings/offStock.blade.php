@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="border-0 shadow-lg bg-light rounded col-md-10 offset-md-1 py-4">
            <h4 class="text-center font-weight-bold pb-4">Produits indisponibles</h4>
            @if(session()->has('notifSuccess'))
                <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3 col-md-10 mx-auto">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <span>{!! session()->get('notifSuccess.notif') !!}</span>
                </div>
            @endif
            <hr class="mt-5">
              @foreach($product as $prod)
              <form class="col-md-10 mx-auto" action="/admin/prod-stock/{{$prod->id}}" method="post">
                @csrf
                <div class="form-check d-flex justify-content-between">
                  <label class="form-check-label px-5 @if($prod->off_stock == 1) text-danger @endif" for="defaultCheck{{$prod->id}}">
                    @if($prod->off_stock == 1)
                    <i class="text-danger far fa-times-circle"></i>
                    @else
                    <i class="text-success far fa-check-circle"></i>
                    @endif
                    {{$prod->name}}
                  </label>
                  <form action="/admin/prod-stock/{{$prod->id}}" method="post">
                    @if($prod->off_stock == 1)
                    <input type="hidden" name="offStock" value="0">
                    <button type="submit" class="col-md-3 btn btn-outline-success px-2">Rendre disponible</button>
                    @else
                    <input type="hidden" name="offStock" value="1">
                    <button type="submit" class="col-md-3 btn btn-outline-danger px-2">Rendre indisponible</button>
                    @endif
                  </form>
                </div>
              </form>
              <hr>
              @endforeach
        </div>
    </div>
@endsection
