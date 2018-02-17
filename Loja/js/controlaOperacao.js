//Clientes

function cadastrarCliente(origemOperacao) {

    var id = $('#id').val();
    var nome = $('#nome').val();
    var sobrenome = $('#sobrenome').val();
    var senha = $('#senha').val();
    var email = $('#email').val();
    var endereco = $('#endereco').val();
    var cep = $('#cep').val();
    var cidade = $('#cidade').val();
    var estado = $('#estado').val();
    var operacao;
    var camposPreenchidos = true;

    if (id == '') {
        operacao = 'incluirCliente';
    } else {
        operacao = 'atualizarCliente';
    }

    if (nome == '') {
        $('#nomeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#nomeObrig').empty();
    }
    if (sobrenome == '') {
        $('#sobrenomeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#sobrenomeObrig').empty();
    }
    if (operacao == 'incluirCliente'
            && senha == '') {
        $('#senhaObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#senhaObrig').empty();
    }
    if (email == '') {
        $('#emailObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#emailObrig').empty();
    }
    if (endereco == '') {
        $('#enderecoObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#enderecoObrig').empty();
    }
    if (cep == '') {
        $('#cepObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#cepObrig').empty();
    }
    if (cidade == '') {
        $('#cidadeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#cidadeObrig').empty();
    }
    if (estado == '') {
        $('#estadoObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#estadoObrig').empty();
    }

    if (!camposPreenchidos) {
        alert('Campos obrigatórios não preenchidos!');
        return false;
    }

    resposta = confirm("Confirma a operação?");
    if (resposta) {
        $.ajax({
            url: "../adm/manterRotina.php",
            method: "POST",
            dataType: "json",
            data: {operacao: operacao,
                id: id,
                nome: nome,
                sobrenome: sobrenome,
                senha: senha,
                email: email,
                endereco: endereco,
                cep: cep,
                cidade: cidade,
                estado: estado},
            success: function (data) {
                alert(data.msg);
                if (data.status == 'OK') {
                    if (origemOperacao == 'adm') {
                        window.location = "listaClientes.php";
                    } else {//loja
                        window.location = "login.php";
                    }
                }
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }});
    }
}

function excluirCliente(id) {
    resposta = confirm("Deseja realmente excluir esse cliente?");
    if (resposta) {
        $.ajax({
            url: "manterRotina.php",
            method: "GET",
            dataType: "json",
            data: {
                operacao: 'excluirCliente',
                id: id
            },
            success: function (data) {
                alert(data.msg);
                location.reload();
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }
        });
    }
}

//Categoria

function cadastrarCategoria() {
    var nome = $('#nome').val();
    var id = $('#id').val();
    var operacao;
    var camposPreenchidos = true;

    if (id === '') {
        operacao = 'incluirCategoria';
    } else {
        operacao = 'atualizarCategoria';
    }

    if (nome == '') {
        $('#nomeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#nomeObrig').empty();
    }

    if (!camposPreenchidos) {
        alert('Campos obrigatórios não preenchidos!');
        return false;
    }

    resposta = confirm("Confirma a operação?");
    if (resposta) {
        $.ajax({
            url: "manterRotina.php",
            method: "POST",
            dataType: "json",
            data: {operacao: operacao,
                id: id,
                nome: nome},
            success: function (data) {
                alert(data.msg);
                window.location = "listaCategorias.php";
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }});
    }
}

function excluirCategoria(id) {
    resposta = confirm("Deseja realmente excluir essa categoria?");
    if (resposta) {
        $.ajax({
            url: "manterRotina.php",
            method: "GET",
            dataType: "json",
            data: {
                operacao: 'excluirCategoria',
                id: id
            },
            success: function (data) {
                alert(data.msg);
                location.reload();
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }
        });
    }
}

//Produto

function cadastrarProduto() {
    var id = $('#id').val();
    var idCategoria = $('#categoria').val();
    var nome = $('#nome').val();
    var descricao = $('#descricao').val();
    var preco = $('#preco').val();
    var qtEstoque = $('#qtEstoque').val();
    var foto = $('#foto').val();
    var operacao;
    var camposPreenchidos = true;

    if (id === '') {
        operacao = 'incluirProduto';
    } else {
        operacao = 'atualizarProduto';
    }

    if (nome == '') {
        $('#nomeObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#nomeObrig').empty();
    }
    if (idCategoria == '') {
        $('#categoriaObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#categoriaObrig').empty();
    }
    if (descricao == '') {
        $('#descricaoObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#descricaoObrig').empty();
    }
    if (preco == '') {
        $('#precoObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#precoObrig').empty();
    }
    if (qtEstoque == '') {
        $('#qtEstoqueObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#qtEstoqueObrig').empty();
    }
    if (operacao == 'incluirProduto'
            && foto == '') {
        $('#fotoObrig').html('*');
        camposPreenchidos = false;
    } else {
        $('#fotoObrig').empty();
    }

    if (!camposPreenchidos) {
        alert('Campos obrigatórios não preenchidos!');
        return false;
    }

    resposta = confirm("Confirma a operação?");
    if (resposta) {
        $.ajax({
            url: "manterRotina.php",
            method: "POST",
            dataType: "json",
            data: {id: id,
                operacao: operacao,
                idCategoria: idCategoria,
                nome: nome,
                descricao: descricao,
                preco: preco,
                qtEstoque: qtEstoque},
            success: function (data) {
                alert(data.msg);
                if (foto != '') {
                    upload(data.id);
                } else {
                    window.location = "listaProdutos.php";
                }
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }});
    }
}

function upload(id) {
    var data = new FormData();
    var foto = $('#foto')[0].files[0];

    data.append('operacao', 'upload');
    data.append('id', id);
    data.append('foto', foto);

    $.ajax({
        url: "manterRotina.php",
        method: "POST",
        processData: false,
        contentType: false,
        dataType: "json",
        data: data,
        success: function (data) {
            if (data.status == 'OK') {
                window.location = "listaProdutos.php";
            } else {
                alert(data.msg);
            }
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("Erro ao efetuar a operação!");
        }});
}

function mostrarFoto(id) {
    var d = new Date();
    $('#imagem').empty();
    var html = '<br/>';
    html += '<img src="../img/fotos/tb_' + id + '.jpg?time=' + d.getTime() + '" style="display: block; margin-left: auto; margin-right: auto;">';
    html += '<br/>';
    $('#imagem').html(html);
}

function onChangeFoto() {
    $("#foto").each(function (index) {
        if ($("#foto").eq(index).val() != "") {
            readURL(this);
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagem').empty();
            var html = '<br/>';
            html += '<img src="' + e.target.result + '" width="120" height="120" style="display: block; margin-left: auto; margin-right: auto;">';
            html += '<br/>';
            $('#imagem').html(html);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function excluirProduto(id) {
    resposta = confirm("Deseja realmente excluir esse produto?");
    if (resposta) {
        $.ajax({
            url: "manterRotina.php",
            method: "GET",
            dataType: "json",
            data: {
                operacao: 'excluirProduto',
                id: id
            },
            success: function (data) {
                alert(data.msg);
                location.reload();
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Erro ao efetuar a operação!");
            }
        });
    }
}

function onChangeCategoria() {
    location.href = 'listaProdutos.php?acao=listar&categoria=' + $('#categoria').val();
}

function calcularFrete() {
    var cep = $('#cep').val();

    if (cep == '') {
        alert('Cep deve ser informado!')
        return false;
    }

    $.ajax({
        url: "frete.php",
        method: "GET",
        dataType: "html",
        data: {
            cep: cep
        },
        success: function (data) {
            $('#frete').val(data);
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("Erro ao efetuar a operação!");
        }
    });
}

function carregaProdutos() {
    $('#produtos').html('');

    var id_categoria = $('#categoria').val();

    $.ajax({
        url: "itens.php",
        method: "GET",
        dataType: "html",
        data: {
            id_categoria: id_categoria
        },
        success: function (response) {
            $('#produtos').html(response);
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("Erro ao efetuar a operação!");
        }
    });
}

function alteraQuantidade(id, qtd) {
    if (qtd == 0) {
        alert('Quantidade Invalida!');
        location.reload();
        return false;
    }

    $.ajax({
        url: "carrinho.php",
        method: "GET",
        dataType: "html",
        data: {action: 'update',
            id: id,
            qtd: qtd
        }, success: function (data) {
            if (data == '-1') {
                $('input[name="' + id + '"]').val('1');
                alert('Quantidade excedida em estoque. Informe uma quantidade menor');
            }
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("Erro ao efetuar a operação!");
        }
    });
}

function finalizaCompra() {
    var frete = $('#frete').val();
    var cep = $('#cep').val();

    if (cep == '') {
        alert('Cep deve ser informado!');
        return false;
    }
    if (frete == '') {
        alert('Frete deve ser calculado!');
        return false;
    }

    $.ajax({
        url: "carrinho.php",
        method: "GET",
        dataType: "html",
        data: {
            action: 'finalizarCompra',
            frete: frete,
            cep: cep.toString()
        },
        success: function (resposta) {
            alert(resposta);
            window.location = "index.php";
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            alert("Erro ao efetuar a operação!");
        }
    });
}
