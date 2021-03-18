class UpdateForm{
constructor() {
}
    removeReadonly(){
        $(document).on('click','#updateForm', function(){
            $('.updateUser').prop("readonly" , false);
            $('.oldAddress').html(`
                <p class="text-center pt-2">Vérifiez votre éligibilité à la livraison👇</p>
                  <div class="input-group">
                    <input list="addressAPIUpdate" id="addressUpdate" type="text" class="form-control border-bottom"
                           name="addressUpdate" placeholder="Ex: 30 rue du pont 06560 Sophia Antipolis" value="">
                    <datalist id="addressAPIUpdate">
                    </datalist>
                    <button id="radiusVerifyUpdate" type="" class="btn btn-outline-secondary" type="button">Verifier</button>
                  </div>
                <small class="rayonMsgUpdate font-italic text-muted">Rayon de livraison de 2,5km maximun</small>
                <span class="alertDeliveryUpdate"></span>
              `)
            $(".newsletterGroup").html(`
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="newsletter" id="newsletter1" value="1" checked>
                  <label class="form-check-label" for="newsletter1">
                    Se abonner à notre newsletter
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="newsletter" id="newsletter2" value="0">
                  <label class="form-check-label" for="newsletter2">
                    Se desabonner de notre newsletter
                  </label>
                </div>
            `);
            $('.btnDivUpdate').html(`
                <a id="updateReturn" href="/" class="btn btn-secondary col-md-12">
                    Anuller
                </a>
                <button id="sendUpdate" class="btn btn-success col-md-12 mt-2">
                    Confirmer
                </button>`);
        })
    }
}
