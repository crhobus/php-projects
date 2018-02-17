$(document).ready(function () {

    $('#login').click(doLogin);
    $("#agencia").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#nrConta").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#senha").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#letrasSeguranca").keypress(function (event) {
        return caracteresMaiusculos(event);
    });

});

function doLogin() {
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();
    var vSenha = $('#senha').val();
    var vLetrasSeguranca = $('#letrasSeguranca').val();

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
    if (vSenha == '') {
        alert('Informe a senha');
        $('#senha').focus();
        return;
    }
    if (vLetrasSeguranca == '') {
        alert('Informe as letras de segurança');
        $('#letrasSeguranca').focus();
        return;
    }
    if (vSenha.length != 6) {
        alert('A senha deve ter 6 dígitos!');
        return false;
    }
    if (vLetrasSeguranca.length != 3) {
        alert('Letras de segurança deve ter 3 dígitos!');
        return false;
    }

    var func = function (data) {
        if (data.login == 'DADOS') {
            $('#msg').html('Agência/Conta inválida');
            $('#agencia').val('');
            $('#nrConta').val('');
        } else if (data.login == 'SENHA_NUMERICA') {
            $('#msg').html('Senha inválida');
            $('#senha').val('');
        } else if (data.login == 'SENHA_LETRA') {
            $('#msg').html('Letras de segurança inválida');
            $('#letrasSeguranca').val('');
        } else if (data.login == 'TENTATIVAS') {
            $('#msg').html('Você ultrapassou o limite de tentativas de acesso!');
        } else if (data.login == 'LOGOU') {
            $('#msg').empty();
            $(window.document.location).attr('href', 'internetBanking.php');
        }
    };

    $.post('../../include/control/LoginCliente.php',
            {agencia: vAgencia, nrConta: vNrConta, senha: vSenha, letrasSeguranca: vLetrasSeguranca}, func, 'json');
}
