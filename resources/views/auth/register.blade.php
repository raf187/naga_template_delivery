<div class="col-md-10 offset-md-1" >
    <div class="p-3">
        <form id="subSingInForm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="lastName">{{ __('Nom') }}</label>
                <input id="lastName" type="text" class="form-control border-bottom @error('lastName') is-invalid @enderror"
                       name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
            </div>

            <div class="form-group">
                <label for="firstName">{{ __('Prénom') }}</label>

                <input id="firstName" type="text" class="form-control border-bottom @error('firstName') is-invalid @enderror"
                       name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
            </div>

            <div class="form-group">
                <label for="phone">{{ __('Téléphone') }}</label>
                <input id="phone" type="phone" class="form-control border-bottom @error('phone') is-invalid @enderror"
                       name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                <small class="font-italic text-muted">Ex: 06, 07, 04, 09 XXXXXXXX</small>
            </div>

            <div class="form-group">
                <label for="email">{{ __('E-Mail') }}</label>
                <input id="email" type="email" class="form-control border-bottom @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Mot de passe') }}</label>

                <input id="password" type="password" class="form-control border-bottom @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
                <small class="font-italic text-muted">Au moins 6 caractères</small>
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirmation mot de passe') }}</label>

                <input id="password-confirm" type="password" class="form-control border-bottom" name="password_confirmation"
                       required autocomplete="new-password">
            </div>

            <div class="form-group addressDiv">
                <label for="address">{{ __('Adresse') }}</label>
                <p class="addresseJS"></p>
                <input type="hidden" id="addressVerified" name="addressVerified" value="Compte Click&Collect">
                <input type="hidden" id="deliRayon" name="deliRayon" value="0">
            </div>

            <div class="form-group deliInfoDiv">
                <label for="deliInfo">{{ __('Info livraison') }}</label>

                <textarea id="deliInfo" type="text" class="form-control @error('deliInfo') is-invalid @enderror"
                          name="deliInfo" value="{{ old('deliInfo') }}" autocomplete="deliInfo"
                          autofocus placeholder="Entreprise, laisser à l'accueil, appeler avant d'arriver  ..."></textarea>

            </div>
            <div class="form-group">
                <div class="d-flex">
                    <input class="mt-1 mr-1" type="checkbox" name="conditions" id="conditions" required>
                    <label for="conditions">J'ai lu et j'accepte les conditions générales de vente et les mentions légales.</label>
                </div>
            </div>
            <div class="msgDiv alert alert-danger d-none mb-2">
                <span class="alertForm"></span>
            </div>
            <div class="form-group mt-3">
                    <button id="btnSubLogin" type="submit" class="btn btn-success col-md-12">
                        {{ __('Inscription') }}
                    </button>
            </div>
        </form>
    </div>
</div>
