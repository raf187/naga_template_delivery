class MyOrders{

    goToPay(){
            let orderUrl = $('#payMethod option:selected').val();
            if( orderUrl === "TR-PAPIER"){
                $('#TRConfirm').modal("show");
                $('#orderConfirm').modal("hide");

            }else if(orderUrl === "ESPÈCES"){
                $('#Money').modal("show");
                $('#orderConfirm').modal("hide");
            }else {
                const url = "/payOrder/" + orderUrl;
                window.location.replace(url);
            }
    }


    saveOnSession(){
        const that = this;
        $(document).on('click','#payOrder',function (e){
            e.preventDefault()
            $('#orderList').val(`${$('.cartJsonModal').text().trim()}  \r\n ${$('#utensils option:selected').val()}`);
            $.ajax({
                type:'POST',
                url:'/saveOrderOnsession',
                data: $('#submitOrder').serialize(),
                success: function (){
                    that.goToPay()
                }
            })
        })

    }


    getOrdersJson(){
        $(document).on('click', '.userOrdersBtn',  function (e){
            e.preventDefault();
            $.get('/MyOrdersOnJson', orderList => {
                const body = document.querySelector('.bodyOrderList')
                body.innerHTML = "";
                if (orderList) {
                    Object.values(orderList).map(orderList => {
                        if (orderList.length < 1){
                            $('.table').html("<p class='font-weight-bold py-4'>Pas de historique de comandes</p>");
                        }else{
                            for (let i = 0; i < orderList.length; i++) {
                                body.innerHTML += `
                                <tr>
                                    <th scope="row">${orderList[i].orderId}</th>
                                    <td>${orderList[i].orderList}</td>
                                    <td>${new Intl.NumberFormat('fr-FR', {
                                    style: 'currency',
                                    currency: 'EUR'
                                }).format(orderList[i].totalPrice)}</td>
                                    <td>${orderList[i].payMethod}</td>
                                    <td>${orderList[i].created_at.replaceAll("-", "/").slice(0, 10).split("/").reverse().join("/")}</td>

                                </tr>`;
                            }
                        }
                    })
                }
            })
        })
    }
}
