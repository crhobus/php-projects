$(document).ready(function () {

    $('#efetuarPagamento').click(doEfetuarPagamento);
    $('#limpar').click(doLimpar);
    $("#valor").keyup(function () {
        return valor($("#valor"));
    });

});

function doEfetuarPagamento() {
    var vLinhaDigitavel = $('#linhaDigitavel').val();
    var vValor = $('#valor').val().replace(/\./g, '').replace(/\,/g, '.');

    var camposPreenchidos = true;

    if (vLinhaDigitavel == '') {
        $('#linhaDigitavelObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#linhaDigitavelObrig').empty();
    }
    if (vValor == '') {
        $('#valorObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#valorObrig').empty();
    }

    if (!camposPreenchidos) {
        $('#msg').html('Campos obrigatórios não preenchidos!');
        return false;
    } else {
        $('#msg').empty();
    }

    if (vValor <= 0) {
        $('#msg').html('O valor do pagamento deve ser maior que 0!');
        return false;
    }

    var func = function (data) {
        $('#msg').html(data.msg);
    };

    $.post('../../include/control/Movimentacao.php',
            {operacao: 'pag_boleto_banc', valor: vValor}, func, 'json');
}

function doLimpar() {
    $('#linhaDigitavel').val('');
    $('#valor').val('');
    $('#linhaDigitavelObrig').empty();
    $('#valorObrig').empty();
    $('#msg').empty();
}
