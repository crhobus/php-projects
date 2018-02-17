$(document).ready(function () {

    $('#novo').click(doNovo);
    $('#salvar').click(doSalvar);
    $('#limpar').click(doLimpar);
    $('#listar').click(doListar);
    $("#usuario").focus(function () {
        return nomeUsuario();
    });
    $("#senha").keypress(function (event) {
        return caracteresDigitosSenha(event);
    });
    $("#confirmaSenha").keypress(function (event) {
        return caracteresDigitosSenha(event);
    });

});

function doSalvar() {
    var vId = $('#id').val();
    var vNome = $('#nome').val();
    var vUsuario = $('#usuario').val();
    var vSenha = $('#senha').val();
    var vConfirmaSenha = $('#confirmaSenha').val();

    var vOperacao = 'insert';
    if (vId != 0) {
        vOperacao = 'update';
    }

    var camposPreenchidos = true;

    if (vNome == '') {
        $('#nomeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#nomeObrig').empty();
    }
    if (vUsuario == '') {
        $('#usuarioObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#usuarioObrig').empty();
    }
    if (vOperacao == 'insert') {
        if (vSenha == '') {
            $('#senhaObrig').html('*');
            camposPreenchidos = false;
        } else {
            $('#senhaObrig').empty();
        }
        if (vConfirmaSenha == '') {
            $('#confirmaSenhaObrig').html('*');
            camposPreenchidos = false;
        } else {
            $('#confirmaSenhaObrig').empty();
        }
    } else {//update
        if (vSenha != ''
                && vConfirmaSenha == '') {
            $('#confirmaSenhaObrig').html('*');
            camposPreenchidos = false;
        } else {
            $('#confirmaSenhaObrig').empty();
        }
    }

    if (!camposPreenchidos) {
        $('#msg').html('Campos obrigatórios não preenchidos!');
        return false;
    } else {
        $('#msg').empty();
    }

    if (vSenha != vConfirmaSenha) {
        $('#msg').html('A senha deve ser confirmada!');
        return false;
    } else {
        $('#msg').empty();
    }

    var func = function (data) {
        if (data.id != null) {
            $('#id').val(data.id);
            $('#usuario').prop('readonly', true);
        }
        $('#msg').html(data.msg);
    };

    $.post('../../include/control/FuncionarioControl.php',
            {operacao: vOperacao, id: vId, nome: vNome, usuario: vUsuario, senha: vSenha}, func, 'json');
}

function doNovo() {
    $('#id').val('0');
    $('#nome').val('');
    $('#usuario').val('');
    $('#senha').val('');
    $('#confirmaSenha').val('');
    $('#nomeObrig').empty();
    $('#usuarioObrig').empty();
    $('#senhaObrig').empty();
    $('#confirmaSenhaObrig').empty();
    $('#usuario').prop('readonly', false);
    $('#msg').empty();
}

function doLimpar() {
    doNovo();
    $('#funcionarios').empty();
}

function doListar() {
    var func = function (data) {

        doLimpar();

        if (data.msg == 'OK') {

            var html = '<br/>';

            html += '<table class="tabela">';
            html += '<thead>';
            html += '<tr>';
            html += '<th>Nome</th>';
            html += '<th>Usuário</th>';
            html += '<th>Editar</th>';
            html += '<th>Excluir</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            var id = 0;

            $.each(data.funcionarios, function (i, obj) {
                html += '<tr>';
                $.each(obj, function (y, o) {
                    if (id == 0) {
                        id = o;
                    } else {
                        html += '<td>' + o + '</td>';
                    }
                });
                html += '<td class="button_td"><input type="image" src="../../img/edit.png" onclick="doEditar(' + id + ')"></td>';
                html += '<td class="button_td"><input type="image" src="../../img/delete.png" onclick="doExcluir(' + id + ')"></td>';
                html += '</tr>';
                id = 0;
            });

            html += '</tbody>';
            html += '</table>';

            $('#funcionarios').html(html);

        } else {

            $('#msg').html(data.msg);

        }
    };

    $.get('../../include/control/FuncionarioControl.php',
            {operacao: 'list'}, func, 'json');
}

function doEditar(id) {
    var func = function (data) {
        if (data.msg == 'OK') {
            $('#senha').val('');
            $('#confirmaSenha').val('');
            $('#nomeObrig').empty();
            $('#usuarioObrig').empty();
            $('#senhaObrig').empty();
            $('#confirmaSenhaObrig').empty();
            $('#msg').empty();
            $('#id').val(data.funcionario.id);
            $('#nome').val(data.funcionario.nome);
            $('#usuario').val(data.funcionario.usuario);
            $('#usuario').prop('readonly', true);
        } else {
            $('#msg').html(data.msg);
        }
    };

    $.get('../../include/control/FuncionarioControl.php',
            {operacao: 'get', id: id}, func, 'json');
}

function doExcluir(id) {
    var func = function (data) {
        if (data.msg == 'OK') {
            doListar();
        } else {
            $('#msg').html(data.msg);
        }
    };

    $.get('../../include/control/FuncionarioControl.php',
            {operacao: 'delete', id: id}, func, 'json');
}
