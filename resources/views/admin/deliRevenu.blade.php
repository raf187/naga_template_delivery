@extends('layouts.admin')
@section('adminContent')
    <div class="col-md-12 px-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body px-2">
                <div class="table-responsive px-0">
                    <h4 class="text-center font-weight-bold pb-4">Total livraisons fin de service</h4>
                    @if(session()->has('notifSuccess'))
                        <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            <span>{!! session()->get('notifSuccess.notif') !!}</span>
                        </div>
                    @endif
                    <table id="revenue" class="table table-striped table-bordere text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Ticket restaurant</th>
                                <th>Espéces</th>
                                <th>Total Livraisons</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jour</th>
                                <th>Ticket restaurant</th>
                                <th>Espéces</th>
                                <th>Total Livraisons</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($totalTR as $dayDeli)
                                <tr>
                                    <td>{{ date('Y/m/d', strtotime($dayDeli->deli_date)) }}</td>
                                    <td>
                                        @if($dayDeli->total_tr < 0.01)
                                            <form class="text-center m-2" method="post" action="/update-TR-deli/{{$dayDeli->id}}">
                                                @csrf
                                                <span>Ticket-Resto:</span>
                                                <input style="width: 100px" class="" name="deliTR" value="" type="number" required step="0.01" placeholder="0.00">
                                                <button class="ml-1 btn"><i class="text-success fas fa-check-circle"></i></button><br>
                                            </form>
                                        @else
                                            <span>Ticket-Resto: {{ number_format($dayDeli->total_tr, 2, ",", ".") }} €</span>
                                            <a href="/delete-TR-deli/{{$dayDeli->id}}" class="ml-2 btn"><i class="text-danger fas fa-times-circle"></i></a><br>
                                        @endif
                                    </td>
                                    <td>{{ number_format($dayDeli->total_money - $dayDeli->total_tr, 2, ",", ".") }} €</td>
                                    <td> {{ number_format($dayDeli->total_money, 2, ",", ".") }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
