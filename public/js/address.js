class Address{

    constructor(){
        this.nagaLat = 43.621008;
        this.nagaLon = 7.045343;

    }

    localStoreAddress(btn){
      $(btn).click(function(){
        localStorage.setItem('address', JSON.stringify($('#address').val()));
        })
    }

    deliveryList(input, list){
        $(input).on('keyup', function(e){
            $(list).empty();
            let delivery = $(input).val();
            let reqAPI = "https://api-adresse.data.gouv.fr/search/?q=" + delivery + "&limit=5&autocomplete=0";
            if (delivery){
                fetch(reqAPI, {method:'get'}).then(response => response.json()).then(resulAddress => {
                    $.each(resulAddress.features, (ind, val) =>{
                        const adresse = resulAddress.features[ind];
                        $(list).append('<option value="' + adresse.properties.name + " " + adresse.properties.postcode + " " + adresse.properties.city + '">' + adresse.properties.name + " " + adresse.properties.postcode + " " + adresse.properties.city +'</option>');
                    });
                })
            }
        })
    }

    deliveryAddress(btn, input, from, msg, deliRadius){
        $(document).on("click",btn , (e)=>{
          e.preventDefault();
            let delivery = $(input).val();
            let reqAPI = "https://maps.googleapis.com/maps/api/geocode/json?address=" + delivery + "&key=AIzaSyD4ZpLRKxEHm1WLeqRLp7zVsc3phhp7FTY";
            let dist;
            if (delivery !==""){
                $.get(reqAPI, resulAddress=>{
                    let result =  resulAddress.results;
                    $.each(result, (ind, val) =>{
                        dist = this.deliveryRadius(result[ind].geometry.location.lat, result[ind].geometry.location.lng);
                        if(dist > 2.5 && dist < 20){
                          $(deliRadius).val("0");
                          $(msg).html(`
                            <div class="">
                              <p class="">Désolé vous êtes trop loin (${dist} km)!<br>Essayez Uber Eats 👇
                                ou créez un compte Click&Collect pour retirer au restaurant.</p>
                                <a class="btn col-md-12 btn-outline-success mt-2" href="https://www.ubereats.com/fr/cannes/food-delivery/naga-sophia-antipolis/Ly8ty1SfQvacX2CoIfvVsQ" target="_blank"> Uber Eats </a>
                            </div>`);
                        }else if(dist < 2.5){
                          $(deliRadius).val("1");
                          $(from).html(`
                            <div class="text-center">
                              <p class="">Bonne nouvelle on vous livre avec plaisir 👍🏽</p>
                              <button id="deliverySignIn" type="button" class="btn btn-success col-md-12 mb-4">
                                Finaliser l'inscription
                              </button>
                            </div>`);
                        }else if(dist > 20){
                          $(msg).html(`
                            <div class="">
                              <p class="">Votre adresse et a plus de ${dist} km!<br>
                                Êtes-vous sûr d'avoir rentré le bon format?<br>
                                Ex: <u>24 Cours Fragonard 06560 Valbonne</u>
                              </p>
                            </div>`);
                        }else{
                          $(msg).html(`<p class="text-danger">Oups... veuilliez saisir une adresse dans le format demandé.</p>`);
                        }
                    });
                })
            }else{
              $(msg).html(`<p class="text-danger">Oups... veuilliez saisir une adresse dans le format demandé.</p>`)
              $(deliRadius).val("2");
            }
        })
    }

    deliveryAddressUpdate(btn, input, from, msg, deliRadius){
        $(document).on("click",btn , (e)=>{
          e.preventDefault();
            let delivery = $(input).val();
            let reqAPI = "https://maps.googleapis.com/maps/api/geocode/json?address=" + delivery + "&key=AIzaSyD4ZpLRKxEHm1WLeqRLp7zVsc3phhp7FTY";
            let dist;
            if (delivery){
                $.get(reqAPI, resulAddress=>{
                    let result =  resulAddress.results;
                    $.each(result, (ind, val) =>{
                        dist = this.deliveryRadius(result[ind].geometry.location.lat, result[ind].geometry.location.lng);
                        if(dist > 2.5){
                          $(deliRadius).val("0");
                          $(msg).html(`
                            <div class="">
                              <p class="text-danger">Désole vous etes trop loin (${dist} km)!</p>
                            </div>`);
                        }else if(dist < 2.5){
                          $(from).html(`
                            <label for="addressVerified">Adresse</label>
                            <input id="addressVerified" type="text" class="updateUser form-control bg-white border-bottom"
                                   name="addressVerified" value="${delivery}" readonly>
                            <input id="updateAdressVal" name="updateAdressVal" type="hidden" value="1">
                            <p class="text-success">On vous livre avec plaisir!</p>
                            </div>`);
                        }else{
                          $(msg).html(`<p class="text-danger">Oups... veuilliez saisir une adresse dans le format demandé.</p>`);
                        }
                    });
                })
            }else{
              $(msg).html(`<p class="text-danger">Oups... veuilliez saisir une adresse dans le format demandé.</p>`)
              $(deliRadius).val("2");
            }
        })
    }

    deliveryRadius(customerLat,customerLon) {
        const radius = 6371; // Radius of the earth in km
        const dLat = this.deg2rad(this.nagaLat-customerLat);
        const dLon = this.deg2rad(this.nagaLon-customerLon);
        let lat1 = this.deg2rad(this.nagaLat);
        let lat2 = this.deg2rad(customerLat);
        const a =
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.sin(dLon/2) * Math.sin(dLon/2) *
            Math.cos(lat1) * Math.cos(lat2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        const dist = radius * c; // Distance in km
        return dist.toFixed(2);
    }

    deg2rad(deg) {
        return deg * (Math.PI/180)
    }
}
