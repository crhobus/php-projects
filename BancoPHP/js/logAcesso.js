$(document).ready(function () {

    $('#listar').click(doListar);
    $('#gerarPDF').click(doGerarPDF);
    $("#agencia").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#nrConta").keypress(function (event) {
        return somenteNumeros(event);
    });

});

function doListar() {
    var vNome = $('#nome').val();
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();

    var func = function (data) {

        $('#msg').empty();
        $('#logs').empty();

        if (data.msg == 'OK') {

            var html = '<br/>';

            html += '<table class="tabela">';
            html += '<thead>';
            html += '<tr>';
            html += '<th>Cliente</th>';
            html += '<th>Agência</th>';
            html += '<th>Conta</th>';
            html += '<th>Último acesso</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            $.each(data.logs, function (i, obj) {
                html += '<tr>';
                $.each(obj, function (y, o) {
                    html += '<td>' + o + '</td>';
                });
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';

            $('#logs').html(html);

        } else {

            $('#msg').html(data.msg);

        }
    };

    $.get('../../include/control/IbLogControl.php',
            {operacao: 'listar', nome: vNome, agencia: vAgencia, nrConta: vNrConta}, func, 'json');
}

function doGerarPDF() {
    var vNome = $('#nome').val();
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();

    var func = function (data) {
        window.open('gerarLogAcessoPDF.php');
    };

    $.get('../../include/control/IbLogControl.php',
            {operacao: 'listar_pdf', nome: vNome, agencia: vAgencia, nrConta: vNrConta}, func, 'json');
}
