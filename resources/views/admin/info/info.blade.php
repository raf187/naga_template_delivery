@extends('layouts.admin')
@section('adminContent')

        <div class=" p-5">
            <h4 class="text-center font-weight-bold pb-4">Informations service</h4>
            <ul class="nav nav-tabs border-bottom-success" id="myTab" role="tablist">
                @if(count($infoList) > 0)
                @foreach($infoList as $item)
                    <li class="nav-item">
                        <a class="nav-link text-success" id="{{str_replace(' ', '', $item->title)}}-tab" data-toggle="tab" href="#{{str_replace(' ', '', $item->title)}}" role="tab" aria-controls="{{str_replace(' ', '', $item->title)}}" aria-selected="true">{{$item->title}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content border shadow-lg bg-light p-5" id="myTabContent">
                @foreach($infoList as $item)
                    <div class="tab-pane fade px-5" id="{{str_replace(' ', '', $item->title)}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '', $item->title)}}-tab">
                        {!! $item->content !!}
                    </div>
                @endforeach
            </div>
            @else
                <p class="font-weight-bold mx-auto p-5">Pas de info service dans la base de donnes.</p>
            @endif
        </div>
@endsection
