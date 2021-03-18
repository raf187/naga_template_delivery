<div class="modal fade" id="logOut" tabindex="1" role="dialog" aria-labelledby="labelTlogOut" aria-hidden="true">
    <div class="modal-dialog modal-sm text-center" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3">
                <h3 class="text-center text-success font-weight-bold pb-3">Déconnexion</h3>
                <p>Êtes-vous sûr de vouloir vous déconnecter?</p>
            </div>
            <div class="modal-footer row">
                <button class="btn btn-light mr-4" data-dismiss="modal">Anuller</button>
                <a class="btn btn-success" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        {{ __('Déconnexion') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
