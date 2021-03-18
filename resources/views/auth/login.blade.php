
<div class="col-md-10 offset-md-1">
<div class="p-4">
    <form id="logInForm" method="POST" action="{{ route('login') }}">
        <div class="form-group">
            <label for="email">Email</label>
            <input id="logEmail" type="email" class="form-control border-bottom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="logPassword" type="password" class="form-control border-bottom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        </div>
        <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>
        </div>
        <div class="form-group pt-4">
            <div class="logError alert alert-danger d-none mb-2">
                <span class="alertForm"></span>
            </div>
                <button id="logSub" type="submit" class="btn btn-success col-md-12">
                    {{ __('Connexion') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn pt-4 btn-link text-success d-flex justify-content-around" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif
        </div>
      </form>
  </div>
</div>
