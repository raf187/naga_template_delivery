@extends('layouts.admin')
@section('adminContent')
    <div class="p-5">
        <div class="container py-3 col-md-8 offset-md-2 border-0 shadow-lg bg-light rounded ">
            <h4 class="text-center font-weight-bold pb-4">Info client</h4>
            <div class="col-md-8 mx-md-auto">
                <div class="form-group">
                    <label for="updateLastName">{{ __('Nom') }}</label>
                    <input id="updateLastName" type="text" class="updateUser form-control bg-light border-bottom"
                           name="updateLastName" value="{{ $customer->lastName }}" required autocomplete="lastName" autofocus readonly>

                </div>

                <div class="form-group">
                    <label for="updateFirstName">{{ __('Prénom') }}</label>

                    <input id="updateFirstName" type="text" class="updateUser form-control bg-light border-bottom"
                           name="updateFirstName" value="{{ $customer->firstName }}" required autocomplete="firstName" autofocus readonly>
                </div>

                <div class="form-group">
                    <label for="updatePhone">{{ __('Téléphone') }}</label>
                    <input id="updatePhone" type="phone" class="updateUser form-control bg-light border-bottom"
                           name="updatePhone" value="{{ $customer->phone }}" required autocomplete="phone" autofocus readonly>
                </div>

                <div class="form-group">
                    <label for="updateEmail">{{ __('E-Mail') }}</label>

                    <input id="updateEmail" type="email" class="updateUser form-control bg-light border-bottom"
                           name="updateEmail" value="{{ $customer->email }}" required autocomplete="email" readonly>
                </div>

                <div class="form-group">
                    <label for="updateAddress">{{ __('Adresse') }}</label>

                    <input list="addressAPI" id="updateAddress" type="text" class="updateUser form-control bg-light border-bottom"
                           name="updateAddress" value="{{ $customer->address }}" data-val="no" readonly>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="updateDeliInfo">{{ __('Info livraison') }}</label>

                        <textarea id="updateDeliInfo" type="text" class="updateUser form-control bg-white border-0"
                                  name="updateDeliInfo" value="" autocomplete="deliInfo"
                                  autofocus placeholder="Laisser à l'accueill, appler avant de arriver ...">{{ $customer->deliInfo }}</textarea>

                    </div>

                    <div class="form-group">
                        <label for="updateDeliInfo">{{ __('Observations restaurant') }}</label><br>
                        <small class="font-italic text-muted mb-1">Visible seulment par le restaurant</small>
                        <textarea id="adminInfo" type="text" class="adminInfo form-control bg-white border-0"
                                  name="adminInfo" value="" autocomplete="adminInfo"
                                  autofocus>{{ $customer->adminInfo }}</textarea>

                    </div>
                    <div class="form-group d-flex justify-content-around mt-3 row">
                        <a href="/admin/clients" class="btn btn-secondary col-md-4">Annuler</a>
                        <button id="" type="submit" class="btn btn-success col-md-6">
                            {{ __('Mettre à jour les infos') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
