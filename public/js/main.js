
$(window).ready(function () {

    const ajax = new AjaxCalls();
    ajax.singIn();
    ajax.logIn();
    ajax.payUpdate();
    ajax.payUpdateAuto();

    const anim = new Animation();
    anim.signInDisplay();
    anim.btnAnimationAddToCart();
    anim.colapseNav();
    anim.homeMsg();
    anim.dataSpy();
    anim.apiFetchTime();
    anim.msgSession('.msgDivAlert',15000);
    anim.deliType();

    const orderList = new MyOrders();
    orderList.saveOnSession();

    const update = new UpdateForm();
    update.removeReadonly();

    const json = new MyCart();
    json.cartBtnAdd('.addCartForm');
    json.cartBtnUpdates('.btnMinus', '/remove-from-cart/');
    json.cartBtnUpdates('.btnAddDI', '/add-to-cart/');
    json.cartBtnUpdates('.incrase', '/incrase-from-cart/');
    json.cartBtnUpdates('.btnDelete', '/delete-from-cart/');
    json.cartJson();
    json.confimOrder();

    const alert = new Alert();
    alert.beforeSingUp("#btnSubLogin", '#subSingInForm');
    alert.beforeUpdateUser("#sendUpdate", '#updateUserForm');

    const radius = new Address();
    radius.localStoreAddress('#radiusVerify');
    radius.deliveryList('#address', '#addressAPI')
    radius.deliveryAddress('#radiusVerify', '#address', '#radiusForm', '.alertDelivery', '#deliRayon');
    //update modal
    radius.deliveryList('#addressUpdate', '#addressAPIUpdate')
    radius.deliveryAddressUpdate('#radiusVerifyUpdate', '#addressUpdate', '.oldAddress', '.alertDeliveryUpdate', '#deliRayonUpdate');

})
