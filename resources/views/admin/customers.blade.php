@extends('layouts.admin')
@section('adminContent')
    <div class="col-md-12 px-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body px-2">
                <div class="table-responsive px-0">
                        <h4 class="text-center font-weight-bold pb-4">Liste des clients</h4>
                        @if(session()->has('notifSuccess'))
                            <div class="alertFade alert alert-{!! session()->get('notifSuccess.type') !!} text-center py-3">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    &times;
                                </button>
                                <span>{!! session()->get('notifSuccess.notif') !!}</span>
                            </div>
                        @endif
                        <table id="exemple" class="table table-striped table-bordere text-center" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Info livraison</th>
                                <th>Observations</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Info livraison</th>
                                <th>Observations</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($customers as $cust)
                                <tr>
                                    <td>{{ $cust->id }}</td>
                                    <td>{{ $cust->firstName }} {{ $cust->lastName }}</td>
                                    <td>{{ $cust->phone }}</td>
                                    <td>{{ $cust->email }}</td>
                                    <td>{{ $cust->address }}</td>
                                    <td>{{ $cust->deliInfo }}</td>
                                    <td>{{ $cust->adminInfo }}</td>
                                    <td><a href="/admin/client/{{ $cust->id }}"><i class="far fa-edit text-success px-2"></i></a></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection
