@extends('layouts.home')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div
                        class="card-header font-weight-bold text-center text-success">{{ __('Nouveau mot de passe') }}</div>

                    <div class="card-body col-md-10 mx-auto">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                       class="form-control border-bottom @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                       autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Mot de passe') }}</label>

                                <input id="password" type="password"
                                       class="form-control border-bottom @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirmation mot de passe') }}</label>

                                <input id="password-confirm" type="password" class="form-control border-bottom"
                                       name="password_confirmation" required autocomplete="new-password">

                            </div>

                            <div class="form-group row mt-4">
                                <button type="submit" class="col-md-12 btn btn-success">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
