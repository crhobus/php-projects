$(document).ready(function () {

    $('#efetuarRecarga').click(doEfetuarRecarga);
    $('#limpar').click(doLimpar);
    $("#celular").mask("(99) 9999-9999");
    $("#valor").keyup(function () {
        return valor($("#valor"));
    });

});

function doEfetuarRecarga() {
    var vOperadora = $('#operadora').val();
    var vCelular = $('#celular').val();
    var vValor = $('#valor').val().replace(/\./g, '').replace(/\,/g, '.');

    var camposPreenchidos = true;

    if (vOperadora == '') {
        $('#operadoraObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#operadoraObrig').empty();
    }
    if (vCelular == '') {
        $('#celularObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#celularObrig').empty();
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
        $('#msg').html('O valor da recarga deve ser maior que 0!');
        return false;
    }

    var func = function (data) {
        $('#msg').html(data.msg);
    };

    $.post('../../include/control/Movimentacao.php',
            {operacao: 'pag_recarga_cel', valor: vValor}, func, 'json');
}

function doLimpar() {
    $('#operadora').val('');
    $('#celular').val('');
    $('#valor').val('');
    $('#operadoraObrig').empty();
    $('#celularObrig').empty();
    $('#valorObrig').empty();
    $('#msg').empty();
}
