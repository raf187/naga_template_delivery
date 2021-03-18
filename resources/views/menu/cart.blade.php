<div id="menuCart" class="menuCart overflow-auto mx-auto">
    <div class="herderOrder bg-success text-center py-2">
        <h3 class="p-2 m-0 font-weight-bold d-flex justify-content-center">Panier <i class="fas fa-shopping-basket d-flex align-items-center ml-2"><span class="badge badge-warning badge-pill-menu badgeTotal"></span></i></h3>
        <a class="text-dark p-2" href="" data-toggle="modal" data-target="#nagaInfo"><i class="fas fa-info-circle"> infos commande</i></a>
    </div>
    <div class="submitOrder bg-white">
        <div class="orderList pt-2 px-2 d-flex flex-column">
            <div class="myCart px-4">
                <!-- javascript -->
            </div>
        </div>
        <div class="input-group px-1 mt-2">
            <div class="input-group-prepend">
                <label class="input-group-text" for="utensils">
                    <i class="fas fa-utensils"></i>
                </label>
            </div>
            <select class="custom-select" id="utensils">
                <option value="Pas de couverts" selected >Pas de couverts</option>
                <option value="Baguettes">Baguettes</option>
                <option value="Couverts">Couverts</option>
            </select>
        </div>
        <div class="input-group mt-1 px-1 pb-1">
            <div class="input-group-prepend">
                <label class="input-group-text" for="deliTypes">
                    <i class="fas fa-shipping-fast"></i>
                </label>
            </div>
            <select class="deliTimeBorder custom-select" id="deliTypes">
                <option disabled selected hidden value="">Retrait ou livraison</option>
                <option class="deliType1" value="Retrait">Je retire au restaurant</option>
                @guest()
                    <option class="deliType2" value="Livraison">Je me fais livrer</option>
                @endguest
                @role('user|superadministrator|administrator')
                @if(Auth::user()->deliRayon === "1")
                    <option class="deliType2" value="Livraison">Je me fais livrer</option>
                @else
                    <option disabled class="" value="">Pas inscrit à la livraison</option>
                @endif
                <button class="btnCartConfirm btn btn-success mt-1 col-12 text-dark font-weight-bold">Je commande</button>
                @endrole
            </select>
        </div>
        <div class="input-group mt-1 px-1 pb-1 d-none deliDateDiv">
            <div class="input-group-prepend">
                <label class="input-group-text" for="deliDate">
                    <i class="far fa-calendar-alt"></i>
                </label>
            </div>
            <select class="custom-select" id="deliDate">
            </select>
        </div>
        <div class="input-group px-1 d-none deliTimeDiv">
            <div class="input-group-prepend">
                <label class="deliTimeBorder input-group-text" for="deliTime">
                    <i class="far fa-clock"></i>
                </label>
            </div>
            <select class="deliTimeBorder custom-select" id="deliTime">
            </select>
        </div>
        <div class="text-danger errorOrder text-center"></div>
    </div>
    <span class="px-4 py-2 totalCart d-flex justify-content-end bg-success font-weight-bold priceTotal">
    </span>
    @guest()
        <button class="nav-link btn btn-light mt-1 col-12 font-weight-bold text-success btnCart" data-toggle="modal"
                data-target="#connexionTarget">Connectez vous pour comander</button>
    @endguest
    @role('user')
            <button class="btnCartConfirm btn btn-success mt-1 col-12 text-dark font-weight-bold">Je commande</button>
    @endrole
    @role('superadministrator|administrator')
        <button class="btn btn-danger mt-1 col-12 text-dark font-weight-bold">Pas autorisé à commander</button>
    @endrole
</div>
