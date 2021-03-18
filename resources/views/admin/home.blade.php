@extends('layouts.admin')
@section('adminContent')
    <div class="p-0">
        <div class="col-md-12 px-2">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body px-2">
                    <div class="table-responsive px-0">
                        <h4 class="text-center font-weight-bold pb-4">Commandes du jour</h4>
                        <table id="exemple" class="table table-striped table-border " style="width:100%">
                            <thead>
                            <tr>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Type et date</th>
                                <th>Prix</th>
                                <th>Info<br>paiement</th>
                                <th>Date de<br>commande</th>
                                <th>Ticket</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Type et date</th>
                                <th>Prix</th>
                                <th>Info<br>paiement</th>
                                <th>Date de<br>commande</th>
                                <th>Ticket</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($dayOrders as $order)
                                <tr>
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
                                    <td>{{ $order->deliType }}<br> {{ str_replace(":", 'h',$order->deliTime) }}</td>
                                    <td class="text-center">{{ $order->totalPrice }} €</td>
                                    <td class="text-center">
                                        @if($order->payMethod === "ESPÈCES")
                                            <form class="text-center m-2" method="post" action="/update-TR-info/{{ $order->id }}">
                                                @csrf
                                                @if($order->ticketResto < 0.01)
                                                    <span>TR</span>
                                                    <input style="width: 100px" class="" name="trInfo" value="" type="number" required step="0.01" placeholder="0.00">
                                                    <button class="ml-1 btn"><i class="text-success fas fa-check-circle"></i></button><br>
                                                @else
                                                    <span>TR: {{ number_format($order->ticketResto, 2, ",", ".") }} €</span>
                                                    <a href="/delete-TR-info/{{ $order->id }}" class="ml-2 btn"><i class="text-danger fas fa-times-circle"></i></a><br>
                                                @endif
                                            </form>
                                            <form class="text-center m-2" method="post" action="/update-CB-info/{{ $order->id }}">
                                                @csrf
                                                @if($order->cbResto < 0.01)
                                                    <span>CB</span>
                                                    <input style="width: 100px" class="" name="cbResto" value="" type="number" required step="0.01" placeholder="0.00">
                                                    <button class="ml-1 btn"><i class="text-success fas fa-check-circle"></i></button><br>
                                                @else
                                                    <span>CB: {{ number_format($order->cbResto, 2, ",", ".") }} €</span>
                                                    <a href="/delete-CB-info/{{ $order->id }}" class="ml-2 btn"><i class="text-danger fas fa-times-circle"></i></a><br>
                                                @endif
                                            </form>
                                            <span>Espèces: {{ number_format($order->totalPrice - $order->cbResto - $order->ticketResto, 2, ",", ".") }} €</span>
                                        @elseif($order->payMethod === "TR-PAPIER")
                                            <p>Payé à la livraison</p>
                                        @elseif($order->paygreenID !== NULL && $order->payMethod === "TRD" || $order->payMethod === "CB")
                                            <p>Payé en ligne</p>
                                        @else
                                            <p class="font-weight-bold text-uppercase text-danger">Verifier le paiement</p>
                                        @endif
                                    </td>
                                    <td>{{ date('Y/m/d H:i:s', strtotime($order->created_at)) }}</td>
                                    <td>
                                        <a href="print/{{ $order->id }}">
                                            <button class="btn @if($order->orderStatus == 0) btn-info @else btn-success @endif printBtn">
                                                Imprimer <i class="fas fa-print"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
