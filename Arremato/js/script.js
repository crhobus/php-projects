$(document).ready(function () {
    $('#slider').cycle();


    $(function () {
        
        //Ano
        var countdown_year = $('#ano').val();

        //MÊs
        var countdown_month = $('#mes').val();

        //Dia
        var countdown_day = $('#dia').val();

        var timeTo = new Date(parseInt(countdown_year), parseInt(countdown_month - 1), parseInt(countdown_day));

        $('#relogio_contador').countdown({until: timeTo, format: 'HMS'});
       
    });


});
