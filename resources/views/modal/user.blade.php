<div class="modal fade" id="infoUser" tabindex="1" role="dialog" aria-labelledby="infoUser" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body col-md-10 offset-md-1">
                <h2 class="text-center mt-4 text-success orderComfir" id="">Mes Informations</h2>
                <form id="updateUserForm" method="POST" action="/user-update">
                    @csrf
                    <div class="msgDiv alert alert-danger d-none mb-2">
                        <span class="alertForm"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateLastName">{{ __('Nom') }}</label>

                        <input id="updateLastName" type="text" class="updateUser form-control bg-white border-bottom @error('updateLastName') is-invalid @enderror"
                               name="updateLastName" value="{{ Auth::user()->lastName ?? "" }}" required autocomplete="updateLastName" autofocus readonly>

                        @error('updateLastName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="updateFirstName">{{ __('Prénom') }}</label>

                        <input id="updateFirstName" type="text" class="updateUser form-control bg-white border-bottom @error('updateFirstName') is-invalid @enderror"
                               name="updateFirstName" value="{{ Auth::user()->firstName ?? "" }}" required autocomplete="updateFirstName" autofocus readonly>

                        @error('updateFirstName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="updatePhone">{{ __('Téléphone') }}</label>
                        <input id="updatePhone" type="phone" class="updateUser form-control bg-white border-bottom @error('updatePhone') is-invalid @enderror"
                               name="updatePhone" value="{{ Auth::user()->phone ?? "" }}" required autocomplete="updatePhone" autofocus readonly>
                        <small class="font-italic text-muted">Ex: 06, 07, 04, 09 XXXXXXXX</small>
                        @error('updatePhone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="updateEmail">{{ __('E-Mail') }}</label>

                        <input id="updateEmail" type="email" class="updateUser form-control bg-white border-bottom @error('updateEmail') is-invalid @enderror"
                               name="updateEmail" value="{{ Auth::user()->email ?? "" }}" required autocomplete="updateEmail" readonly>

                        @error('updateEmail')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group oldAddress">
                        <label>{{ __('Adresse') }}</label>
                        <p>{{ Auth::user()->address ?? "" }}</p>
                    </div>

                    <div class="form-group">
                        <label for="updateDeliInfo">{{ __('Info livraison') }}</label>

                        <textarea id="updateDeliInfo" type="text" class="updateUser form-control bg-white border-0 @error('updateDeliInfo') is-invalid @enderror"
                                  name="updateDeliInfo" value="" autocomplete="updateDeliInfo"
                                  autofocus placeholder="Entreprise, laisser à l'accueil, appeler avant d'arriver ..." readonly>{{ Auth::user()->deliInfo ?? "" }}</textarea>

                        @error('updateDeliInfo')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="form-group mt-2">
                        @guest
                            <p></p>
                        @else
                            @if(Auth::user()->newsletter === 1)
                                <p>Vous êtes abonné à notre newsletter.</p>
                            @else
                                <p>Vous n'êtes pas abonné à notre newsletter.</p>
                            @endif
                        @endguest
                        <div class="newsletterGroup">
                        </div>
                    </div>
                    <div class="msgDivUpdate alert alert-danger d-none">
                        <span class="alertFormUpdate"></span>
                    </div>
                    <div class="form-group mt-3 btnDivUpdate">
                        <button id="updateForm" class="btn btn-secondary col-md-12">
                            {{ __('Modifier mes infos') }}
                        </button>
                    </div>
                </form>
                <div class="form-group text-center">
                    @if (Route::has('password.request'))
                        <a class="btn pt-4 btn-link text-success d-flex justify-content-around" href="{{ route('password.request') }}">
                            {{ __('Modifier le mot de passe?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-4" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
