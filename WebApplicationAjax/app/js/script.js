$(document).ready(function () {

    //aoCarregar();
    //$('#btnEnviar').click(montarNome);
    $('#btnEnviar').click(montarNome2);

});

function montarNome() {
    var data = $('#formGet').serialize();
    var func = function (data) {
        $('#nomeCompleto').html(data);
    };
    $.get('php/webphp.php', data, func, 'html');
}

function montarNome2() {
    var vNome = $('#nome').val();
    var vSobrenome = $('#sobrenome').val();
    if (vNome == '') {
        alert('Informe o nome');
        $('#nome').focus();
        return;
    }
    if (vSobrenome == '') {
        alert('Informe o sobrenome');
        $('#sobrenome').focus();
        return;
    }
    var func = function (data) {
        $('#nomeCompleto').html(data);
    };
    $.post('php/webphp.php', {nome: vNome, sobrenome: vSobrenome}, func, 'html');
}

function aoCarregar() {
    $.get('php/webphp.php', '', function (data) {
        alert(data);
    });
}