<?php

include "../include/global.php";

$operacao = getValue('operacao');

//Cliente

if ($operacao == 'incluirCliente') {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $ClienteDAO = new ClienteDAO();
    if ($ClienteDAO->verificaEmailCadastrado($email)) {
        echo json_encode(array('status' => 'NOK', 'msg' => 'Já possui um cliente cadastrado no sistema com este email!'));
    } else {
        $ClienteDAO->inserir(new Cliente(NULL, $nome, $sobrenome, md5($senha), $email, $endereco, $cep, $cidade, $estado));
        echo json_encode(array('status' => 'OK', 'msg' => 'Cliente cadastrado com sucesso!'));
    }
}

if ($operacao == 'atualizarCliente') {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $ClienteDAO = new ClienteDAO();

    $idEmail = $ClienteDAO->verificaEmailCadastrado($email);

    if ($idEmail && $idEmail != $id) {
        echo json_encode(array('status' => 'NOK', 'msg' => 'Já possui um cliente cadastrado no sistema com este email!'));
    } else {
        $Cliente = $ClienteDAO->consultar($id);
        $Cliente->setNome($nome);
        $Cliente->setSobrenome($sobrenome);
        if (!empty($senha)) {
            $Cliente->setSenha(md5($senha));
        }
        $Cliente->setEmail($email);
        $Cliente->setEndereco($endereco);
        $Cliente->setCep($cep);
        $Cliente->setCidade($cidade);
        $Cliente->setEstado($estado);

        $ClienteDAO->atualizar($Cliente);
        echo json_encode(array('status' => 'OK', 'msg' => 'Cliente atualizado com sucesso!'));
    }
}

if ($operacao == 'excluirCliente') {

    $id = $_GET['id'];

    $ClienteDAO = new ClienteDAO();
    $retorno = $ClienteDAO->excluir($id);
    if ($retorno) {
        echo json_encode(array('msg' => 'Cliente excluído com sucesso!'));
    } else {
        echo json_encode(array('msg' => 'Não foi possível excluir o cliente!'));
    }
}

// Categoria

if ($operacao == 'incluirCategoria') {

    $nome = $_POST['nome'];

    $CategoriaDAO = new CategoriaDAO();
    $Categoria = new Categoria(NULL, $nome);
    $CategoriaDAO->inserir($Categoria);
    echo json_encode(array('msg' => 'Categoria cadastrada com sucesso!'));
}

if ($operacao == 'atualizarCategoria') {

    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $CategoriaDAO = new CategoriaDAO();
    $Categoria = $CategoriaDAO->consultar($id);

    $Categoria->setNome($nome);

    $CategoriaDAO->atualizar($Categoria);
    echo json_encode(array('msg' => 'Categoria atualizada com sucesso!'));
}

if ($operacao == 'excluirCategoria') {

    $id = $_GET['id'];

    $CategoriaDAO = new CategoriaDAO();
    $retorno = $CategoriaDAO->excluir($id);
    if ($retorno) {
        echo json_encode(array('msg' => 'Categoria excluída com sucesso!'));
    } else {
        echo json_encode(array('msg' => 'Não foi possível excluir a categoria!'));
    }
}

//Produto

if ($operacao == 'incluirProduto') {

    $idCategoria = $_POST['idCategoria'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $qtEstoque = $_POST['qtEstoque'];

    $ProdutoDAO = new ProdutoDAO();
    $ProdutoDAO->inserir(new Produto(NULL, $idCategoria, $nome, $descricao, $preco, 0, $qtEstoque));
    echo json_encode(array('id' => $ProdutoDAO->getLastID(), 'msg' => 'Produto cadastrado com sucesso!'));
}

if ($operacao == 'atualizarProduto') {

    $id = $_POST['id'];
    $idCategoria = $_POST['idCategoria'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $qtEstoque = $_POST['qtEstoque'];

    $ProdutoDAO = new ProdutoDAO();
    $Produto = $ProdutoDAO->consultar($id);

    $Produto->setIdCategoria($idCategoria);
    $Produto->setNome($nome);
    $Produto->setDescricao($descricao);
    $Produto->setPreco($preco);
    $Produto->setQtEstoque($qtEstoque);

    $ProdutoDAO->atualizar($Produto);
    echo json_encode(array('id' => $Produto->getId(), 'msg' => 'Produto atualizado com sucesso!'));
}

if ($operacao == 'excluirProduto') {

    $id = $_GET['id'];

    $ProdutoDAO = new ProdutoDAO();
    $retorno = $ProdutoDAO->excluir($id);
    if ($retorno) {
        if (file_exists("../img/fotos/tb_" . $id . ".jpg")) {
            unlink("../img/fotos/tb_" . $id . ".jpg");
        }
        echo json_encode(array('msg' => 'Produto excluído com sucesso!'));
    } else {
        echo json_encode(array('msg' => 'Não foi possível excluir o produto!'));
    }
}

if ($operacao == 'upload') {

    $id = $_POST['id'];
    $foto = $_FILES['foto']['tmp_name'];

    $ProdutoDAO = new ProdutoDAO();
    $Produto = $ProdutoDAO->consultar($id);
    $upload = move_uploaded_file($foto, '../img/fotos/' . $Produto->getId() . '.jpg');
    if ($upload) {
        $imagemOriginal = ImageCreateFromJPEG('../img/fotos/' . $Produto->getId() . '.jpg');
        $imagemReduzida = ImageCreateTrueColor(120, 120);
        ImageCopyResampled($imagemReduzida, $imagemOriginal, 0, 0, 0, 0, 120, 120, ImagesX($imagemOriginal), ImagesY($imagemOriginal));
        imagejpeg($imagemReduzida, '../img/fotos/tb_' . $Produto->getId() . '.jpg');
        imagedestroy($imagemReduzida);
        imagedestroy($imagemOriginal);
        unlink("../img/fotos/" . $Produto->getId() . ".jpg");
        $Produto->setFoto($id);
        $ProdutoDAO->atualizar($Produto);
        echo json_encode(array('status' => 'OK', 'msg' => ''));
    } else {
        echo json_encode(array('status' => 'NOK', 'msg' => 'Ocorreu um erro ao inserir/atualizar a foto do produto!'));
    }
}

function getValue($key) {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    } else if (isset($_GET[$key])) {
        return $_GET[$key];
    }
    return null;
}


