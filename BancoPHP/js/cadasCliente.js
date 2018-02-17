$(document).ready(function () {

    $('#novo').click(doNovo);
    $('#salvar').click(doSalvar);
    $('#limpar').click(doLimpar);
    $('#listar').click(doListar);
    $("#agencia").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#nrConta").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#senha").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#confirmaSenha").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#letrasSeguranca").keypress(function (event) {
        return caracteresMaiusculos(event);
    });
    $("#nrTentativas").keypress(function (event) {
        return somenteNumeros(event);
    });
    $("#saldoEspecial").keyup(function () {
        return valor($("#saldoEspecial"));
    });

});

function doSalvar() {
    var vId = $('#id').val();
    var vNome = $('#nome').val();
    var vAgencia = $('#agencia').val();
    var vNrConta = $('#nrConta').val();
    var vSenha = $('#senha').val();
    var vConfirmaSenha = $('#confirmaSenha').val();
    var vLetrasSeguranca = $('#letrasSeguranca').val();
    var vSaldoEspecial = $('#saldoEspecial').val().replace(/\./g, '').replace(/\,/g, '.');
    var vNrTentativas = $('#nrTentativas').val();
    var vFoto = $('#foto').val();

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
        if (vLetrasSeguranca == '') {
            $('#letrasSegurancaObrig').html('*');
            camposPreenchidos = false;
        } else {
            $('#letrasSegurancaObrig').empty();
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

    if (vSaldoEspecial == '') {
        $('#saldoEspecialObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#saldoEspecialObrig').empty();
    }

    if (!camposPreenchidos) {
        $('#msg').html('Campos obrigatórios não preenchidos!');
        return false;
    } else {
        $('#msg').empty();
    }

    if (vSenha != ''
            && vSenha.length != 6) {
        $('#msg').html('A senha deve ter 6 dígitos!');
        return false;
    }

    if (vLetrasSeguranca != ''
            && vLetrasSeguranca.length != 3) {
        $('#msg').html('Letras de segurança deve ter 3 dígitos!');
        return false;
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
            $('#nrConta').prop('readonly', true);
            if (vFoto != '') {
                upload();
            }
        }
        $('#msg').html(data.msg);
    };

    $.post('../../include/control/ClienteControl.php',
            {operacao: vOperacao, id: vId, nome: vNome, agencia: vAgencia, nrConta: vNrConta, senha: vSenha, letrasSeguranca: vLetrasSeguranca, saldoEspecial: vSaldoEspecial, nrTentativas: vNrTentativas}, func, 'json');
}

function upload() {
    var data = new FormData();
    var vId = $('#id').val();
    var vFoto = $('#foto')[0].files[0];

    data.append('operacao', 'upload');
    data.append('id', vId);
    data.append('foto', vFoto);

    $.ajax({url: '../../include/control/ClienteControl.php',
        method: 'POST',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: data})
            .success(function (data) {
                if (data.msg == 'OK') {
                    mostrarFoto(vId);
                } else {
                    $('#msg').html(data.msg);
                }
            })
            .error(function (obj, status, erro) {
                $('#msg').html('Ocorreu um erro ao inserir/atualizar a foto do cliente!');
            });
}

function mostrarFoto(id) {
    var d = new Date();
    $('#imagem').empty();
    var html = '<br/>';
    html += '<img src="../../img/fotos/tb_' + id + '.jpg?time=' + d.getTime() + '">';
    html += '<br/>';
    $('#imagem').html(html);
}

function doNovo() {
    $('#id').val('0');
    $('#nome').val('');
    $('#agencia').val('');
    $('#nrConta').val('');
    $('#senha').val('');
    $('#confirmaSenha').val('');
    $('#letrasSeguranca').val('');
    $('#foto').val('');
    $('#imagem').empty();
    $('#saldoEspecial').val('0');
    $('#nrTentativas').val('0');
    $('#nomeObrig').empty();
    $('#agenciaObrig').empty();
    $('#nrContaObrig').empty();
    $('#senhaObrig').empty();
    $('#confirmaSenhaObrig').empty();
    $('#letrasSegurancaObrig').empty();
    $('#saldoEspecialObrig').empty();
    $('#nrConta').prop('readonly', false);
    $('#nrTentativas').prop('readonly', true);
    $('#msg').empty();
}

function doLimpar() {
    doNovo();
    $('#clientes').empty();
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
            html += '<th>Agência</th>';
            html += '<th>Conta</th>';
            html += '<th>Cheque Especial</th>';
            html += '<th>Tentativas de Acesso</th>';
            html += '<th>Editar</th>';
            html += '<th>Excluir</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            var id = 0;

            $.each(data.clientes, function (i, obj) {
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

            $('#clientes').html(html);

        } else {

            $('#msg').html(data.msg);

        }
    };

    $.get('../../include/control/ClienteControl.php',
            {operacao: 'list'}, func, 'json');
}

function doEditar(id) {
    var func = function (data) {
        if (data.msg == 'OK') {
            $('#senha').val('');
            $('#confirmaSenha').val('');
            $('#letrasSeguranca').val('');
            $('#foto').val('');
            $('#imagem').empty();
            $('#nomeObrig').empty();
            $('#agenciaObrig').empty();
            $('#nrContaObrig').empty();
            $('#senhaObrig').empty();
            $('#confirmaSenhaObrig').empty();
            $('#letrasSegurancaObrig').empty();
            $('#saldoEspecialObrig').empty();
            $('#msg').empty();
            $('#id').val(data.cliente.id);
            $('#nome').val(data.cliente.nome);
            $('#agencia').val(data.cliente.agencia);
            $('#nrConta').val(data.cliente.nrConta);
            $('#saldoEspecial').val(data.cliente.saldoEspecial.replace(/\./g, ','));
            $('#nrTentativas').val(data.cliente.nrTentativas);
            $('#nrConta').prop('readonly', true);
            $('#nrTentativas').prop('readonly', false);
            if (data.cliente.foto != '0') {
                mostrarFoto(data.cliente.id);
            }
        } else {
            $('#msg').html(data.msg);
        }
    };

    $.get('../../include/control/ClienteControl.php',
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

    $.get('../../include/control/ClienteControl.php',
            {operacao: 'delete', id: id}, func, 'json');
}
