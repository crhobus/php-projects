$(document).ready(function () {

    $('#obterExtrato').click(doObterExtrato);
    $("#dtInicial").mask("99/99/9999");
    $("#dtFinal").mask("99/99/9999");

});

function doObterExtrato() {
    var vDtInicial = $('#dtInicial').val();
    var vDtFinal = $('#dtFinal').val();

    if (vDtInicial == '') {
        alert('Informe uma data de início');
        $('#dtInicial').focus();
        return;
    }
    if (vDtFinal == '') {
        alert('Informe uma data final');
        $('#dtFinal').focus();
        return;
    }

    var func = function (data) {

        $('#msg').empty();
        $('#extrato').empty();

        if (data.msg == 'OK') {

            var html = '<br/>';

            html += '<table class="tabela">';
            html += '<thead>';
            html += '<tr>';
            html += '<th>Cliente</th>';
            html += '<th>Agência</th>';
            html += '<th>Conta</th>';
            html += '<th>Dt Transação</th>';
            html += '<th>Descrição</th>';
            html += '<th>Valor</th>';
            html += '<th>Tipo</th>';
            html += '<th>Operação</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            $.each(data.extrato, function (i, obj) {
                html += '<tr>';
                $.each(obj, function (y, o) {
                    html += '<td>' + o + '</td>';
                });
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';

            $('#extrato').html(html);

        } else {

            $('#msg').html(data.msg);

        }
    };

    $.get('../../include/control/Movimentacao.php',
            {operacao: 'extrato', dtInicial: vDtInicial, dtFinal: vDtFinal}, func, 'json');
}
