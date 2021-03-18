@extends('layouts.admin')
@section('adminContent')
    <form method="post" id="orderStatusUpdate" action="/print/{{ $orderPrint->id }}">
        @csrf
        <input type="hidden" name="orderStatus" value="1">
            <button type="submit" class="btn @if($orderPrint->orderStatus == 0) btn-info @else btn-success @endif startPrint col-12 py-5 ">
                Imprimer <i class="fas fa-print"></i>
            </button>
    </form>
<div class="display-3" id="ticketBeforePrint">
    <div id="ticket" class="bg-white pb-5 px-3">
        <div class="d-flex justify-content-center m-0 p-0">
            <img class="m-0 p-0" src="{{ asset('/media/logoTicket.png') }}" style="width:580px" alt="logo naga">
        </div>
        <p class="text-center font-weight-bold my-1">www.naga-sophia.com</p>
        <p class="text-center text-muted ticketMenu">Siret: 88087597600016<br>5610Z-FR01880875976</p>
        <div class="pt-5">
            <p class="m-0 font-weight-bolder ticketMenu">Nom: {{ $user->firstName }} {{ $user->lastName }}</p>
            <p class="m-0 font-weight-bolder ticketMenu">Tel.: {{ $user->phone }}</p>
            <p class="m-0 font-weight-bolder ticketMenu">Adresse:<br>{{ $user->address }}</p>
            @if($orderPrint->deliType === "Livraison" && !empty($user->deliInfo))
            <p class="m-0 font-weight-bolder ticketMenu">Complément:<br>{{ $user->deliInfo }}</p>
            @endif
            <p class="m-0 font-weight-bold">
            @if($orderPrint->deliType === "Livraison")
                @if( $orderPrint->deliTime === "11H45")
                    Livraison 11h45 - 12h15
                @elseif( $orderPrint->deliTime === "12H45")
                    Livraison 12h45 - 13h30
                @endif
            @else
                Retrait à {{str_replace(":", "h", $orderPrint->deliTime)}}
            @endif
            @if($orderPrint->deliType === "Retrait" && $orderPrint->payMethod === 'ESPÈCES')
                <p class="font-weight-bold text-uppercase">À payer au restaurant</p>
            @elseif($orderPrint->deliType === "Livraison" && $orderPrint->payMethod === 'TR-PAPIER')
                <p class="font-weight-bold text-uppercase">Payer à la livraison</p>
            @elseif($orderPrint->paygreenID !== null && $orderPrint->payMethod === "TRD" || $orderPrint->payMethod === "CB")
                <p class="font-weight-bold text-uppercase">Payé en ligne</p>
            @else
                <p class="font-weight-bold text-uppercase">Verifier le paiement</p>
            @endif
        </div>
        <hr class="my-5">
        <p class="pb-5 font-weight-bolder ticketMenu">Commande n°{{ $orderPrint->orderId }}</p>
        <div class="font-weight-bolder m-0 ticketMenu">
            <div class="row">
            @foreach($orderPrint->orderList as $key=>$item)
                @if($key > 20)
                        <div class="col-9 font-weight-bolder">{{ $item['quantity'] }} x {{ $item['attributes']['code'] !== null ? $item['attributes']['code'] : $item['name']}}</div>
                        <div class="col-3 d-flex font-weight-bolder justify-content-end">{{number_format($item['quantity'] * $item['price'], 2, ',', ' ')}} €</div>
                    @if($item['attributes']['extra'] !== null)
                            @foreach($item['attributes']['extra'] as $attr)
                                <div class="col-9 font-weight-bolder" style="font-size: 42px">{{ $item['quantity'] }} x {{ $attr['name']}}</div>
                                @if($attr['price'] > 0)
                                    <div class="col-3 font-weight-bolder d-flex justify-content-end" style="font-size: 42px">{{number_format($item['quantity'] * $attr['price'], 2, ',', ' ')}} €</div>
                                @endif
                            @endforeach
                    @endif
                @else
                        <div class="col-9">{{ $item['qty'] }} x {{ $item['code'] !== null ? $item['code'] : $item['name']}}</div>
                        <div class="col-3 d-flex justify-content-end">{{number_format($item['qty'] * $item['price'], 2, ',', ' ')}} €</div>
                @endif
            @endforeach
            </div>
                @if($orderPrint->deliSup > 0)
                <div class="row pt-3">
                    <div class="col-9">Supplément livraison</div>
                    <div class="col-3">{{ number_format($orderPrint->deliSup, 2, ',', ' ') }} €</div><br>
                </div>
                @endif
        <span class="">{{ $orderPrint->utensils }}</span>
        </span>
        @if($orderPrint->infoOrder)
        <p class="font-weight-bolder">Commentaire<br>{{$orderPrint->infoOrder}}</p>
        @endif
        <hr class="my-5">
        <p class="d-flex justify-content-end font-weight-bolder pt-5">Total TTC: {{number_format($orderPrint->totalPrice, 2, ',', ' ')}} €</p>
        <div class="text-muted tvaSection pb-5">
            @if($orderPrint->tva6 > 0)
                <div class="d-flex justify-content-between">
                    <p class="m-0">T.V.A. 5.5%</p><span class="ml-5">{{number_format($orderPrint->tva6, 2, ',', ' ')}} €</span>
                </div>
            @endif
            @if($orderPrint->tva10 > 0)
                    <div class="d-flex justify-content-between">
                        <p class="m-0">T.V.A. 10%</p><span class="ml-5">{{number_format($orderPrint->tva10, 2, ',', ' ')}} €</span>
                    </div>

            @endif
            @if($orderPrint->tva20 > 0)
                    <div class="d-flex justify-content-between">
                        <p class="m-0">T.V.A. 20%</p><span class="ml-5">{{number_format($orderPrint->tva20, 2, ',', ' ')}} €</span>
                    </div>
            @endif
                <p class="d-flex justify-content-end mt-2">Total HT: {{number_format($orderPrint->totalPrice - $orderPrint->tva20 - $orderPrint->tva10 - $orderPrint->tva6, 2, ',', ' ') }} €</p>

        </div>

        <p class="text-center font-weight-bold pt-5">Bon appétit et à bientôt</p>
        <p class="text-center pb-5">Le {{date("d/m/Y à H:i")}}</p>

    </div>
</div>

@endsection
