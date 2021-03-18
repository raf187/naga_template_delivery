<div class="modal fade" id="modPayMethod" tabindex="1" role="dialog" aria-labelledby="labelmodPayMethod" aria-hidden="true">
    <div class="modal-dialog modal-sm text-center" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3">
                <h3 class="text-center text-success font-weight-bold pb-3">Modifier paiement</h3>
                <form class="m-2" method="post" id="modPayForm">
                    @csrf
                    <div class="input-group mt-1 px-1 pb-2">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="">
                                <i class="fas fa-euro-sign"></i>
                            </label>
                        </div>
                        <select class="custom-select" name="updPayMethod">
                            <option name="cbResto" id="payCB" value="CB-RESTO">Carte bancaire</option>
                            <option name="payTR-PAPIER" id="payTR-PAPIER" value="TR-PAPIER">Ticket restaurant</option>
                            <option name="payESPÈCES" id="payESPÈCES" value="ESPÈCES">Espéces</option>
                        </select>
                    </div>
                    <div class="form-group text-center d-flex justify-content-around py-3 row">
                        <button class="btn btn-light col-5" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="col-5 btn btn-success">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
