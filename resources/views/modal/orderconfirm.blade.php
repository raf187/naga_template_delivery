<div class="modal fade" id="orderConfirm" tabindex="1" role="dialog" aria-labelledby="orderConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3">
                <h3 class="text-success text-center py-4">Ma commande</h3>
                <!--<form>-->
                <form id="submitOrder">
                    @csrf
                    <div class="col-md-8 offset-md-2">
                        @if(Auth::user())
                            <span class="row deliDateJS"></span>
                            <input class="deliDateInp border-0 ml-1" id="deliDateInp" name="deliDateInp" type="hidden" value="">
                            <span class="delidataTime row"></span>
                            <input class="deliTimeJS border-0 ml-1" id="" name="deliTime" type="hidden" value="">
                            <span class="mb-3 pr-1 row">Commande n° <span class="orderUserId">{{ Auth::user() ? Auth::user()->id : 0 }}</span><span class="orderIdJs"></span></span>
                            <input name="orderId" id="orderId" type="hidden" value="1">
                            <div class="cartJsonModal"></div>
                            <input name="orderList" id="orderList" type="hidden" value="">
                            <div class="mx-2 mt-2"><span class="row"><input name="utensils" class="utensilsConfirm border-0" type="text" value="" readonly></span>
                            <span id="deliPrice"></span></div>
                            <input name="deliSup" id="deliSup" type="hidden" value="0">
                            <input name="deliType" id="deliType" type="hidden" value="">
                            <div class="modalPriceFormat row font-weight-bold d-flex justify-content-end pt-1"></div>
                            <input class="font-weight-bold ml-1 modalPrice border-0" type="hidden" name="modalPrice" id="modalPrice" readonly value="">
                            <small class="font-italic text-muted">* Un récapitulatif vous sera envoyé par email</small>
                            <!--<textarea name="infoOrder" class="col-12 mt-3" placeholder="Avez-vous des commentaires à transmettre?"></textarea>-->
                        @endif
                    </div>
                    <hr class="font-weight-bold">
                    <div class="text-center">
                        <h3 class="text-success">Chosisez votre moyen de paiment</h3>
                        <a class="text-success" href="" data-toggle="modal" data-target="#nagaInfo" data-dismiss="modal"><i class="fas fa-info-circle"> infos paiement</i></a>
                        <div class="col-md-10 pt-4 offset-md-1">
                            <div class="input-group mt-1 px-1 pb-2">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="payMethod">
                                        <i class="fas fa-euro-sign"></i>
                                    </label>
                                </div>
                                <select class="custom-select" name="payMethod" id="payMethod">
                                </select>
                            </div>
                            <div class="form-group text-center py-3">
                                <button id="payOrder" class="col-md-12 btn btn-success">Passer commande</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-4" data-dismiss="modal">Retour</button>
            </div>
        </div>
    </div>
</div>
