@extends('layouts.admin')
@section('adminContent')
    <div class="col-md-12 px-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body px-2">
                <div class="table-responsive px-0">
                    <h4 class="text-center font-weight-bold pb-4">Les access autorisés</h4>
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
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Accès</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Accès</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->lastName }}</td>
                                <td>{{ $admin->firstName }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>
                                    @if($admin->hasRole('administrator'))
                                        Employé
                                    @elseif($admin->hasRole('superadministrator'))
                                        Admin
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="/admin/modifier-admin/{{ $admin->id }}"><i class="far fa-edit text-success mr-4"></i></a>
                                        <a class="deleteBtnConfirm" href="/admin/sup-admin/{{ $admin->id }}"><i class="far fa-trash-alt text-danger"></i></a>
                                    </div>
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
