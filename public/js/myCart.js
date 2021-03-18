class MyCart {

    constructor() {

    }

    cartJson() {
        const panier = document.querySelector('.myCart');
        const priceSpan = document.querySelector('.priceTotal');
        $.get('/myCartOnJson', function (jsonCart) {
            panier.innerHTML = ""
            priceSpan.innerHTML = "";
            let totalQty = jsonCart['subQty'];
            let totalPrice = jsonCart['total'];
            let menuCart = jsonCart['cart'];
            $('.badgeTotal').text(`${totalQty ? totalQty : 0}`);
            if (totalQty > 0) {
                priceSpan.innerHTML = `Total:
                ${new Intl.NumberFormat('fr-FR', {
                    style: 'currency',
                    currency: 'EUR'
                }).format(totalPrice)}`;
                Object.values(menuCart).map(menuCart => {
                    let part2 = '';
                    let ext = menuCart.attributes.extra === null ? "" : menuCart.attributes.extra;
                    let part1 = `
                    <div class="row d-flex justify-content-between pb-0 font-weight-bold">
                        <span>${menuCart.name}</span>
                        <a href="/delete-from-cart/${menuCart.id}" class="text-danger btnOrder"><i data-dataid="${menuCart.id}" class="btnDelete fas fa-trash-alt"></i></a>
                    </div>
                        <ul class="m-0 text-muted">`;

                    Object.values(ext).map(ext => {
                        part2 += `
                            <li class="d-flex justify-content-between">
                                <span>${menuCart.quantity} x ${ext.name}</span>
                                <span>${ext.price === null ? "" : new Intl.NumberFormat('fr-FR', {
                            style: 'currency',
                            currency: 'EUR'
                        }).format(menuCart.quantity * ext.price)}</span>
                            </li>
                        `});

                    let part3 = `</ul><div class="row d-flex justify-content-between font-weight-bold border-bottom border-dark">
                      <div>
                            <a href="/remove-from-cart/${menuCart.id}" class="text-danger btnOrder"><i data-dataid="${menuCart.id}" class="btnMinus fas fa-minus-circle"></i></a>
                             <span class="px-3">${menuCart.quantity}</span>
                            <a href="/incrase-from-cart/${menuCart.id}" class="text-success btnOrder"><i data-dataid="${menuCart.id}" class="incrase fas fa-plus-circle"></i></a>
                      </div>
                      <div>
                            ${new Intl.NumberFormat('fr-FR', {
                        style: 'currency',
                        currency: 'EUR'
                    }).format(menuCart.quantity * menuCart.price)}
                      </div>
                    </div>
                `;
                    panier.innerHTML += part1 + part2 + part3;

                });
            } else {
                panier.innerHTML = `
                <div class="text-center font-weight-bold">
                    <span class="cartEmpty">Votre panier et vide</span>
                </div>
                `;
                priceSpan.innerHTML = `Total: 0 €`;
            }
        })
        $('.form-check-input').prop("checked", false);
    }

    cartBtnUpdates(btn, url) {
        let that = this;
        $(document).on('click', btn, function (e) {
            e.preventDefault();
            let id = $(this).attr('data-dataId');
            $.get(url + id, function (data) {
                if (data) {
                    that.cartJson();
                }
            });

        })
    }

    cartBtnAdd(form) {
        let that = this;
        $(document).on('submit', form , function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content')
                }
            });
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data){
                    if (data) {
                        that.cartJson();
                    }
                }
            })
        })
    }


    orderId() {
        let date = +new Date;
        let orderId = date.toString().slice(6, 12);
        return orderId;
    }

    confimOrder() {
        const that = this;
        $(document).on('click', '.btnCartConfirm', function () {
            const cartEmpty = $('.cartEmpty')
            let deliTime = $('#deliTime option:selected').val();
            let deliDate = $('#deliDate option:selected');
            let deliType = $('#deliTypes option:selected').val();
            const totalPrice = $('.priceTotal').text();
            $('.errorOrder').empty();
            $.get('/myCartOnJson', function (jsonCart) {
                let totalQty = jsonCart['subQty'];
                let totalPrice = jsonCart['total'];
                let menuCart = jsonCart['cart'];
                if (totalPrice < 9.9) {
                    $('.errorOrder').append('Un plat minimum !')
                }else if (!deliType) {
                    $('.errorOrder').append('Retrait ou livraison ?')
                }else if (!deliTime) {
                    $('.errorOrder').append('Ajoutez une date et heure !')
                }else {
                    /*cartJsonModal*/
                    let cartJsonModal = document.querySelector('.cartJsonModal');
                    let part1;
                    let part2;
                    cartJsonModal.innerHTML = "";
                    Object.values(menuCart).map(menuCart => {
                        let part2 = '';
                        let ext = menuCart.attributes.extra === null ? "" : menuCart.attributes.extra;
                        part1 = `<div class="d-flex justify-content-between"><span class="DBdata">${menuCart.quantity} x ${menuCart.name}</span>\r\n<span>${new Intl.NumberFormat('fr-FR', {
                            style: 'currency',
                            currency: 'EUR'
                        }).format(menuCart.quantity * menuCart.price)}</span></div><ul class="pl-2 m-0 text-muted">`;
                        Object.values(ext).map(ext => {
                            part2 += `
                            <li class="d-flex justify-content-between supOrderConfirm">
                                <span>${menuCart.quantity} x ${ext.name}</span>
                                <span>${ext.price === null ? "" : new Intl.NumberFormat('fr-FR', {
                                style: 'currency',
                                currency: 'EUR'
                            }).format(menuCart.quantity * ext.price)}</span>
                            </li>
                        `});
                        cartJsonModal.innerHTML += part1 + part2 + "</ul>";
                    });

                    let totalFinal = totalPrice + parseFloat($('#deliSup').val());
                    $('.modalPrice').val(totalFinal);
                    $('.modalPriceFormat').text(`Total TTC: ${new Intl.NumberFormat('fr-FR', {
                        style: 'currency',
                        currency: 'EUR'
                    }).format(totalFinal)}`);

                    /*cartInfosModal*/
                    const utensils = $('#utensils option:selected').val();
                    deliTime = $('#deliTime option:selected').val();
                    $('#orderConfirm').modal("show");
                    $('.orderIdJs').text(that.orderId());
                    $('.deliDateJS').text($('#deliTypes option:selected').text());
                    $('.utensilsConfirm').empty().val(utensils);
                    $('.deliDateInp').val(deliDate.val());
                    $('.delidataTime').empty().text(`Le ${deliDate.text()} à ${deliTime}`)
                    $('.deliTimeJS').val(deliTime);
                    $('#deliType').val($('#deliTypes option:selected').val())
                    $('#orderId').val(`${$('.orderUserId').text()}${$('.orderIdJs').text()}`);

                    if($('#deliTypes option:selected').val() === "Retrait"){
                      $('#payMethod').empty();
                      $('#payMethod').append(`
                        <option name="payCB" id="payCB" value="CB">Carte bancaire</option>
                        <option name="payTRD" id="payTRD" value="TRD">Carte ticket restaurant (Apetiz, Pass Restaurant, Chèque Déjeuner)</option>
                        <!--<option name="payRESTOFLASH" id="payRESTOFLASH" value="RESTOFLASH">Resto Flash</option>
                        <option name="payLUNCHR" id="payLUNCHR" value="LUNCHR">Swile</option>-->
                        <option id='payMONEY' value='ESPÈCES'>Payer au restaurant</option>
                        `);
                    }else if($('#deliTypes option:selected').val() === "Livraison"){
                      $('#payMethod').empty();
                      $('#payMethod').append(`
                        <option name="payCB" id="payCB" value="CB">Carte bancaire</option>
                        <option name="payTRD" id="payTRD" value="TRD">Carte ticket restaurant (Apetiz, Pass Restaurant, Chèque Déjeuner)</option>
                        <!--<option name="payRESTOFLASH" id="payRESTOFLASH" value="RESTOFLASH">Resto Flash</option>
                        <option name="payLUNCHR" id="payLUNCHR" value="LUNCHR">Swile</option>-->
                        <option name="payTR-PAPIER" id="payTR-PAPIER" value="TR-PAPIER">Ticket restaurant papier et appoint en espéces</option>
                        `);
                    }


                }
            })
        })
    }

}
