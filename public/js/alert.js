class Alert{
    constructor() {
    }

    alertSingIn(input, size, array){
            const inputVal = $(input).val();
            const label = $(`label[for="${$(input).prop('id')}"]`).text();
            if (inputVal.length < size) {
                array.push(`${label} doit contenir au moins ${size} caractères`);
            }
    }

    passwordVerify(inputPass, inputPassVerify, array){
            const textPass = $(inputPass).val();
            const textPassVerify = $(inputPassVerify).val();
            if (textPass !== textPassVerify){
                array.push(`Les mots de passe ne correspond pas`);
            }
    }

    emailVerify(input, array){
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const mail = $(input).val();
            if (regex.test(mail)){
            }else{
                array.push(`Le champ email et invalide`);
            }
    }

    phoneVerify(input, array){
            const regex = /^(\+33|0033|0)(4|6|7|9)[0-9]{8}$/g;
            const phone = $(input).val();
            if (regex.test(phone)){
            }else{
                array.push('Telephone et invalide');
            }
    }

    checkConditions(input, btnSub, array){
            if ($(input).is(':checked')){
            }else{
                array.push('Le champ conditions générales doit être accepté.');
            }
    }

    addressSub(input, msg, helpMsg, inputVal, array){
            if ($(inputVal).val() === "2" || $(inputVal).val() === ""){
                array.push('Une erreur avec l\'adresse');
            }

    }

    beforeSingUp(button, form){
        const that = this;
        $(document).on('click', button, function (e) {
            e.preventDefault()
            const array = [];
            that.alertSingIn('#firstName', 1, array);
            that.alertSingIn('#lastName', 1, array);
            that.phoneVerify('#phone', array);
            that.emailVerify('#email', array);
            that.alertSingIn('#password', 6, array);
            that.passwordVerify('#password','#password-confirm', array);
            that.addressSub('#address', '.alertDelivery', '.rayonMsg', '#adressVal', array);
            that.checkConditions('#conditions', '#btnSub', array);
            if (array.length > 0){
                $('.msgDiv').removeClass('d-none');
                $('.alertForm').html(array.join(`, <br>`));
            }
            else {
                $(form).submit();
            }
        })
    }

    beforeUpdateUser(button, form){
        const that = this;
        $(document).on('click',button, function (e) {
            e.preventDefault();
            const array = [];
            that.alertSingIn('#updateFirstName', 1, array);
            that.alertSingIn('#updateLastName', 1, array);
            that.phoneVerify('#updatePhone', array);
            that.emailVerify('#updateEmail', array);
            that.addressSub('#updateAddress', '.updateAlertDelivery', '.updateRayonMsg', '#updateAdressVal', array);
            if (array.length > 0){
                $('.msgDivUpdate').removeClass('d-none');
                $('.alertFormUpdate').html(array.join(`, <br>`));
            }
            else {
                $(form).submit();
            }
        })
    }

    beforeCreateAdmin(button, form){
        const that = this;
        $(document).on('click',button, function (e) {
            e.preventDefault()
            const array = [];
            that.alertSingIn('#adminFirstName', 1, array);
            that.alertSingIn('#adminLastName', 1, array);
            that.phoneVerify('#adminPhone', array);
            that.emailVerify('#adminEmail', array);
            that.alertSingIn('#password', 6, array);
            that.passwordVerify('#password','#password-confirm', array);
            if (array.length > 0){
                $('.msgDivAdmin').removeClass('d-none');
                $('.alertFormAdmin').html(array.join(`, <br>`));
            }
            else {
                $(form).submit();
            }
        })
    }

    beforeUpdateAdmin(button, form){
        const that = this;
        $(document).on('click',button, function (e) {
            e.preventDefault()
            const array = [];
            that.alertSingIn('#adminFirstName', 1, array);
            that.alertSingIn('#adminLastName', 1, array);
            that.phoneVerify('#adminPhone', array);
            that.emailVerify('#adminEmail', array);
            if (array.length > 0){
                $('.msgDivAdmin').removeClass('d-none');
                $('.alertFormAdmin').html(array.join(`, <br>`));
            }
            else {
                $(form).submit();
            }
        })
    }

}
