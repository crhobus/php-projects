$(document).ready(function () {

    $('#efetuarTransferencia').click(doEfetuarTransferencia);
    $('#limpar').click(doLimpar);
    $("#agencia").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#nrConta").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#valor").keyup(function () {
        return valor($("#valor"));
    });

});

function doEfetuarTransferencia() {
    var vAgenciaClieLogado = $('#agenciaClieLogado').val();
    var vNrContaClieLogado = $('#nrContaClieLogado').val();
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();
    var vValor = $('#valor').val().replace(/\./g, '').replace(/\,/g, '.');

    var camposPreenchidos = true;

    if (vAgencia == '') {
        $('#agenciaObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#agenciaObrig').empty();
    }
    if (vNrConta == '') {
        $('#nrContaObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#nrContaObrig').empty();
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
        $('#msg').html('O valor da transferência deve ser maior que 0!');
        return false;
    }

    if (vAgencia == vAgenciaClieLogado
            && vNrConta == vNrContaClieLogado) {
        $('#msg').html('A Agência/Conta deve ser diferente da Agência/Conta logada!');
        return false;
    }

    var func = function (data) {
        $('#msg').html(data.msg);
    };

    $.post('../../include/control/Movimentacao.php',
            {operacao: 'transferencia', agencia: vAgencia, nrConta: vNrConta, valor: vValor}, func, 'json');
}

function doLimpar() {
    $('#agencia').val('');
    $('#nrConta').val('');
    $('#valor').val('');
    $('#agenciaObrig').empty();
    $('#nrContaObrig').empty();
    $('#valorObrig').empty();
    $('#msg').empty();
}
