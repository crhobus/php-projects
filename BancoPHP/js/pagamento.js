$(document).ready(function () {

    $('#ok').click(doOK);
    $('#cancelar').click(doCancelar);
    $('#pagar').click(doPagar);
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

function doOK() {
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();

    if (vAgencia == '') {
        alert('Informe a agência');
        $('#agencia').focus();
        return;
    }
    if (vNrConta == '') {
        alert('Informe a conta');
        $('#nrConta').focus();
        return;
    }

    var func = function (data) {
        if (data.msg == 'OK') {
            $('#msg').empty();
            $('#linhaDigitavel').val('');
            $('#valor').val('');
            $('#id').val(data.cliente.id);
            $('#agencia').prop('readonly', true);
            $('#nrConta').prop('readonly', true);
            if (data.cliente.foto != '0') {
                mostrarFoto(data.cliente.id);
            }
        } else {
            $('#msg').html(data.msg);
        }
    };

    $.get('../../include/control/ClienteControl.php',
            {operacao: 'obter_id_cliente', agencia: vAgencia, nrConta: vNrConta}, func, 'json');
}

function mostrarFoto(id) {
    var d = new Date();
    $('#imagem').empty();
    var html = '<br/>';
    html += '<img src="../../img/fotos/tb_' + id + '.jpg?time=' + d.getTime() + '">';
    html += '<br/>';
    $('#imagem').html(html);
}

function doCancelar() {
    $('#id').val('0');
    $('#agencia').val('');
    $('#nrConta').val('');
    $('#linhaDigitavel').val('');
    $('#valor').val('');
    $('#imagem').empty();
    $('#agencia').prop('readonly', false);
    $('#nrConta').prop('readonly', false);
    $('#msg').empty();
}

function doPagar() {
    var vId = $('#id').val();
    var vLinhaDigitavel = $('#linhaDigitavel').val();
    var vValor = $('#valor').val().replace(/\./g, '').replace(/\,/g, '.');

    if (vId == '0') {
        $('#msg').html('Para realizar um pagamento é necessário selecionar um cliente');
        return false;
    }
    if (vLinhaDigitavel == '') {
        $('#msg').html('Informe a linha digitável');
        return false;
    }
    if (vValor == '') {
        $('#msg').html('Informe um valor');
        return false;
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
