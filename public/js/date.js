class DateFetch{

    deliDate(){
        $.get('/apiClosingDates', function (dates){
            let dateApi = dates['orderDates'];
            $('#deliDate').append('<option disabled selected hidden value="">Choisissez une date</option>');
            $.each(dateApi, (i, v) =>{
                $("#deliDate").append(`<option id="dateOption${dateApi[i].name}" value="${dateApi[i].dateFormat}">${dateApi[i].dayWeek}</option>`);
            });
        })
    }

    deliveryTime(){
          $.get('/apiClosingDates', function (time){
              let deliTimeToday = time['deliTimeToday'];
              let deliTimeTomorow = time['deliTimeTomorow']
              if($('#dateOptiontoday').is(':selected')){
                  $('#deliTime').empty();
                if (deliTimeToday.length < 1) {
                  $('#deliTime').append(`
                    <option disabled selected value="">Pas ou plus de livraison aujourd'hui</option>`);
                }else{
                  $('#deliTime').append('<option disabled selected hidden value="">Choisissez un horaire</option>');
                  $.each(deliTimeToday,function (i){
                      let deliTToday = deliTimeToday[i]['deli_time_setup'].slice(0, 5).replace(":", "H");
                      $('#deliTime').append(`<option class="opt" value="${deliTToday === "13H00" ? "12H45" : deliTToday}">${deliTToday === "13H00" ? "12H45" : deliTToday}</option>`);
                  })
                }
              }else if($('#dateOptiontomorow').is(':selected')){
                $('#deliTime').empty();
                  if (deliTimeTomorow.length < 1) {
                      $('#deliTime').append(`
                    <option disabled selected value="">Pas ou plus de livraison aujourd'hui</option>`);
                  }else {
                      $('#deliTime').append('<option disabled selected hidden value="">Choisissez un horaire</option>');
                      $.each(deliTimeTomorow,function (i){
                          let deliTTomorow = deliTimeTomorow[i]['deli_time_setup'].slice(0, 5).replace(":", "H");
                          $('#deliTime').append(`<option class="opt" value="${deliTTomorow === "13H00" ? "12H45" : deliTTomorow}">${deliTTomorow === "13H00" ? "12H45" : deliTTomorow}</option>`);
                      })
                  }
              } else {
                  $('#deliTime').append(`<option disabled selected value="">Choisissez une date</option>`);
              }
            })
    }

    collectTime(){
        $.get('/apiClosingDates', function (time){
            let collectTimeToday = time['collectTimeToday'];
            let collectTimeTomorow = time['collectTimeTomorow'];
            if($('#dateOptiontoday').is(':selected')){
              $('#deliTime').empty();
              $('#deliTime').append('<option disabled selected hidden value="">Choisissez un horaire</option>');
                $.each(collectTimeToday,function (i){
                    let collectTToday = collectTimeToday[i]['clickAndCollectTime'].slice(0, 5).replace(":", "H");
                    $('#deliTime').append(`<option class="opt" value="${collectTToday}">${collectTToday}</option>`);
                })
            } else if($('#dateOptiontomorow').is(':selected')) {
              $('#deliTime').empty();
              $('#deliTime').append('<option disabled selected hidden value="">Choisissez un horaire</option>');
                $.each(collectTimeTomorow,function (i){
                    let collectTTomorow = collectTimeTomorow[i]['clickAndCollectTime'].slice(0, 5).replace(":", "H");
                    $('#deliTime').append(`<option class="opt" value="${collectTTomorow}">${collectTTomorow}</option>`);
                })
            }else{
                $('#deliTime').empty();
                $('#deliTime').append(`<option disabled selected value="">Choisissez une date</option>`);
            }
        });

    }
}
