<div class="col-md-10 offset-md-1" >
    <div id="radiusForm" class="my-3">
            <div class="form-group">
                <p class="text-center">Vérifiez votre éligibilité à la livraison👇</p>
                  <div class="input-group">
                    <input list="addressAPI" id="address" type="text" class="form-control border-bottom"
                           name="address" placeholder="Ex: 30 rue du pont 06560 Sophia Antipolis" value="">
                    <datalist id="addressAPI">
                    </datalist>
                    <input type="hidden" name="deliRayonSave" id="deliRayonSave" value="">
                    <button id="radiusVerify" type="" class="btn btn-outline-secondary" type="button">Verifier</button>
                  </div>
                <small class="rayonMsg font-italic text-muted">Rayon de livraison de 2,5km maximun</small>
                <span class="alertDelivery"></span>
            </div>
    </div>
      <div class="separateur py-1">
        <div class="ligne"></div>
        <i class="fas fa-circle px-2"></i>
        <div class="ligne"></div>
      </div>
      <div class="form-group my-3">
        <p class="text-center">Pour un retrait au restaurant 👇</p>
        <button id="clickAndCollect" type="" class="btn btn-success col-md-12">
          {{ __('Click & Collect') }}
        </button>
      </div>
</div>
