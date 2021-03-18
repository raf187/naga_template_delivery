@extends('layouts.home')

@section('content')
    <div>
        @include('home.home')
    </div>
    <div>
        @include('home.menu')
    </div>
    <div>
        @include('home.history')
    </div>
    <div>
        @include('home.footer')
    </div>

    @include('modal.info')
    @include('modal.connexion')
    @include('modal.orderconfirm')
    @include('modal.orderList')
    @include('modal.opening')
    @include('modal.user')
    @include('modal.ticketRestoConfirm')
    @include('modal.moneyConfirm')
    @include('modal.conditionsVente')
    @include('modal.metionsLegales')
    @include('modal.signIn')


@endsection
