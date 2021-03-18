class AjaxCalls{

    singIn(){
        $(document).on('submit', '#subSingInForm', function (e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content')
                }
            });
            $.ajax({
                method: $(this).prop('method'),
                url: $(this).prop('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (){
                    window.location.href = '/';
                }
            })
        })
    }

    logIn(){
        $(document).on('submit', '#logInForm', function (e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content')
            }
            });

            $.ajax({
                method: $(this).prop('method'),
                url: $(this).prop('action'),
                data: $(this).serialize(),
                success: function (data){
                    window.location.href = "/loginRole";
                },
                error: function (data) {
                    $('.logError').removeClass('d-none');
                    $('.alertForm').text('Email ou mot de passe incorrectes');
                }
            })
        })
    }
    payUpdateAuto(){
        setInterval(function (){
            $.get('/ordersNotComfirmed')
        }, 60000)
    }
    payUpdate(){
        $.get('/ordersNotComfirmed')
    }
}
