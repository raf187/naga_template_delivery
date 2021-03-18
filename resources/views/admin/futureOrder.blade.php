@extends('layouts.admin')
@section('adminContent')
    <div class="col-md-12 px-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body px-2">
                <div class="table-responsive px-0">
                    <h4 class="text-center font-weight-bold pb-4">Commandes à venir</h4>
                    <table id="exemple" class="table table-striped table-border" style="width:100%">
                        <thead>
                        <tr>
                            <th>N° commande</th>
                            <th>Commande</th>
                            <th>Client</th>
                            <th>Prix</th>
                            <th>Type et date</th>
                            <th>Date commande</th>
                            <th>Info<br>paiement</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>N° commande</th>
                            <th>Commande</th>
                            <th>Client</th>
                            <th>Prix</th>
                            <th>Type et date</th>
                            <th>Date commande</th>
                            <th>Info<br>paiement</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($futuresOrders as $order)
                            <tr>
                                <td>{{ $order->orderId }}</td>
                                <td style="width: 160px">
                                    @foreach($order->orderList as $key=>$item)
                                        @if($key > 20)
                                            <span>{{ $item['quantity'] }} x {{ $item['attributes']['code'] !== null ? $item['attributes']['code'] : $item['name']}}</span><br>
                                            @if($item['attributes']['extra'] !== null)
                                                @foreach($item['attributes']['extra'] as $attr)
                                                    <span class="pl-1 text-muted">{{ $item['quantity'] }} x {{ $attr['name']}}</span><br>
                                                @endforeach
                                            @endif
                                        @else
                                            <span>{{ $item['qty'] }} x {{ $item['code'] !== null ? $item['code'] : $item['name']}}</span><br>
                                        @endif
                                    @endforeach
                                    <hr>
                                    <span>{{ $order->utensils }}</span>
                                </td>
                                <td><a href="/admin/client/{{ $order->user_id }}">{{ $order->firstName }}<br>{{ $order->lastName }}</a></td>
                                <td>{{ $order->totalPrice }} €</td>
                                <td>{{ $order->deliType }} {{ str_replace(":", 'h',$order->deliTime) }}<br>{{ date('d/m/Y', strtotime($order->deliDate)) }}</td>
                                <td>{{ date('Y/m/d H:i:s', strtotime($order->created_at)) }}</td>
                                <td>
                                    @if($order->ticketResto < 0.01 && $order->payMethod === "TR-PAPIER")
                                        <p>Ticket-resto</p>
                                    @else
                                        <p>Pas de TR</p>
                                    @endIf
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
