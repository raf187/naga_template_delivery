@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="container py-3 col-md-8 offset-md-2 border-0 shadow-lg bg-light rounded ">
            <h4 class="text-center font-weight-bold pb-4">Modifier admin</h4>
                <form class="col-md-8 mx-md-auto" id="adminSingInFormUpdate" method="POST" action="">
                    @csrf
                    <div class="msgDiv alert alert-danger d-none mb-2">
                        <span class="alertForm"></span>
                    </div>
                    <div class="form-group">
                        <label for="adminLastName">{{ __('Nom') }}</label>

                        <input id="adminLastName" type="text" class="form-control border-bottom @error('adminLastName') is-invalid @enderror"
                               name="adminLastName" value="{{ $getAdmin->lastName }}" required autocomplete="adminLastName" autofocus>

                        @error('adminLastName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="adminFirstName">{{ __('Prénom') }}</label>

                        <input id="adminFirstName" type="text" class="form-control border-bottom @error('adminFirstName') is-invalid @enderror"
                               name="adminFirstName" value="{{ $getAdmin->firstName }}" required autocomplete="adminFirstName" autofocus>

                        @error('adminFirstName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="adminPhone">{{ __('Téléphone') }}</label>
                        <input id="adminPhone" type="phone" class="form-control border-bottom @error('adminPhone') is-invalid @enderror"
                               name="adminPhone" value="{{ $getAdmin->phone }}" required autocomplete="adminPhone" autofocus>
                        <small class="font-italic text-muted">Ex: 06, 07, 04, 09 XXXXXXXX</small>
                        @error('adminPhone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="adminEmail">{{ __('E-Mail') }}</label>

                        <input id="adminEmail" type="email" class="form-control border-bottom @error('adminEmail') is-invalid @enderror"
                               name="adminEmail" value="{{ $getAdmin->email }}" required autocomplete="adminEmail">

                        @error('adminEmail')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="">Nivaux de autorisation</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" id="employeeStatus" value="2" @if($getAdmin->hasRole('administrator')) checked @endif">
                            <label class="form-check-label" for="adminStatus">
                                Employé
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role_id" id="adminStatus" value="1" @if($getAdmin->hasRole('superadministrator')) checked @endif">
                            <label class="form-check-label" for="adminStatus">
                                Admin
                            </label>
                        </div>
                    </div>
                    <div class="msgDivAdmin alert alert-danger d-none mb-2">
                        <span class="alertFormAdmin"></span>
                    </div>
                    <div class="form-group mt-3 row d-flex justify-content-between">
                        <a href="/admin/liste-admin" class="btn btn-secondary col-md-4">Annuler</a>
                        <button id="updateAdmin" type="submit" class="btn btn-success col-md-7">
                            {{ __('Modifier') }}
                        </button>
                    </div>
                </form>
        </div>
    </div>
@endsection
