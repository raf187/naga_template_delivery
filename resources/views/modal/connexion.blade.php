<div class="modal fade" id="connexionTarget" tabindex="1" role="dialog" aria-labelledby="connexionTargetLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mx-auto">
                <div class="mx-auto">
                    <ul class="nav nav-pills pillsModal" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-conn-tab" data-toggle="pill" href="#pills-conn" role="tab" aria-controls="pills-conn" aria-selected="true">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-signIn-tab" data-toggle="pill" href="#pills-signIn" role="tab" aria-controls="pills-address" aria-selected="false">Inscription</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ////////////////// login modal ///////////////////// -->
            <div class="modal-body">
                <div class="tab-content row" id="pills-tabContent">
                    <div class="tab-pane col-md-12 fade show active" id="pills-conn" role="tabpanel" aria-labelledby="pills-conn-tab">
                        @include('auth.login')
                        <div class="modal-footer col-md-10 offset-md-1">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                    <!-- ////////////////// modal form sign in ///////////////////// -->
                    <div class="tab-pane col-md-12 fade" id="pills-signIn" role="tabpanel" aria-labelledby="pills-signIn-tab">
                      @include('modal.logRadius')
                        <div class="modal-footer col-md-10 offset-md-1">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
