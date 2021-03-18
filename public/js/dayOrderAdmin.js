class DayOrder {

    getOrder() {
        const that = this;
        $.get('/admin/ajax-commande-du-jour', function (order) {
            order = order.order
            let oldList = order.length
            that.ajaxRefresh(oldList)
        })
    }

    ajaxRefresh(order) {
        const audio = new Audio('/media/notif2.mp3')
        const that = this;
        setInterval(function () {
            $.get('/admin/ajax-commande-du-jour', function (orderRefresh) {
                orderRefresh = orderRefresh.order
                let newList = orderRefresh.length
                if (newList > order) {
                    order = newList
                    audio.play();
                    setTimeout(function (){
                        location.reload();
                    },6000)
                }
            })
        }, 20000)
    }
}
