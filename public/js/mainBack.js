$(document).ready(function () {

    const dayOrder = new DayOrder();
    dayOrder.getOrder();

    const ajax = new AjaxCalls();
    ajax.payUpdate();
    ajax.payUpdateAuto();

    const anim = new Animation();
    anim.msgSession('.alertFade',5000);
    anim.printTicket();
    anim.infoService();
    anim.updatePayMethod()
    anim.deleteConfirm();

    const alert = new Alert();
    alert.beforeCreateAdmin('#newAdmin', '#adminSingInForm');
    alert.beforeUpdateAdmin('#updateAdmin','#adminSingInFormUpdate');

})
