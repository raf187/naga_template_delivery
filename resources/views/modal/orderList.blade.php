<div class="modal fade" id="userOrders" tabindex="1" role="dialog" aria-labelledby="userOrders" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3 orderTab">
                <h4 class="text-center py-4 text-success font-weight-bolder orderComfir">Mes 10 derniers commandes</h4>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ma commande</th>
                        <th scope="col">prix</th>
                        <th scope="col">moyen de paiement</th>
                        <th scope="col">Type de retrait</th>
                        <th scope="col">Jour de la commande</th>
                    </tr>
                    </thead>
                    <tbody class="bodyOrderList">
                    @foreach($orderList as $order)
                    <tr>
                        <td>{{ $order->orderId }}</td>
                        <td>
                            @foreach($order->orderList as $key=>$item)
                                @if($key > 20)
                                    <span>{{ $item['quantity'] }} x {{$item['name']}}</span><br>
                                    @if($item['attributes']['extra'] !== null)
                                        @foreach($item['attributes']['extra'] as $attr)
                                            <span class="pl-1 text-muted">{{ $item['quantity'] }} x {{ $attr['name']}}</span><br>
                                        @endforeach
                                    @endif
                                @else
                                    <span>{{ $item['qty'] }} x {{ $item['name']}}</span><br>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ number_format($order->totalPrice, 2, ",", ".") }} €</td>
                        <td>{{ $order->payMethod }}</td>
                        <td>{{ $order->deliType }}</td>
                        <td>{{ date('d/m/Y', strtotime($order->deliDate)) }} {{ str_replace(":", 'h',$order->deliTime) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-4" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
