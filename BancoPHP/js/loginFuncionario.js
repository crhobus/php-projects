$(document).ready(function () {

    $('#login').click(doLogin);

});

function doLogin() {
    var vUsuario = $('#usuario').val();
    var vSenha = $('#senha').val();

    if (vUsuario == '') {
        alert('Informe o usuário');
        $('#usuario').focus();
        return;
    }
    if (vSenha == '') {
        alert('Informe a senha');
        $('#senha').focus();
        return;
    }

    var func = function (data) {
        if (data.login == 'USUARIO') {
            $('#msg').html('Usuário inválido');
            $('#usuario').val('');
            $('#senha').val('');
        } else if (data.login == 'SENHA') {
            $('#msg').html('Senha inválida');
            $('#senha').val('');
        } else if (data.login == 'LOGOU') {
            $('#msg').empty();
            $(window.document.location).attr('href', 'bankAdministrator.php');
        }
    };

    $.post('../../include/control/LoginFuncionario.php',
            {usuario: vUsuario, senha: vSenha}, func, 'json');
}
