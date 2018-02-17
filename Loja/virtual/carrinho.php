<?php

include "../include/global.php";

$action = isset($_GET['action']) ? $_GET['action'] : "";

function adicionarItem($item) {

    $valor = 1;

    foreach ($_COOKIE['carrinho'] as $cookie_name => $cookie_value) {

        if ($cookie_name == $item) {
            $valor = $cookie_value + 1;
        }
    }

    $cookieName = "carrinho[{$item}]";

    setcookie($cookieName, $valor, time() + 3600);
}

function pegaItems() {
    return $_COOKIE['carrinho'];
}

if ($action == 'add') {

    $id = $_GET['id'];

    adicionarItem($id);

    header("Location: index.php");
}

if ($action == 'delete') {
    $id_cookie = $_GET['id'];

    setcookie("carrinho[$id_cookie]", "", time() - 3600);

    header("Location: sacola.php");
}

if ($action == 'update') {

    $id_cookie = $_GET['id'];
    $qtd = $_GET['qtd'];

    $ProdutoDAO = new ProdutoDAO();
    $Produto = $ProdutoDAO->consultar($id_cookie);
    if ($qtd > $Produto->getQtEstoque()) {
        echo -1;
    } else {
        setcookie("carrinho[$id_cookie]", $qtd, time() + 3600);
    }
}


if ($action == 'finalizarCompra') {

    $VirtualSession = new VirtualSession();
    $ClienteDAO = new ClienteDAO();
    $CarrinhoDAO = new CarrinhoDAO();
    $ProdutoDAO = new ProdutoDAO();

    $CarrinhoProdutosDAO = new CarrinhoProdutosDAO();

    $Cliente = $ClienteDAO->consultar($VirtualSession->obterClienteSession());


    $id_cliente = $Cliente->getId();
    $data = date("Y/m/d");
    $ip = $_SERVER["REMOTE_ADDR"];
    $cep = $_GET['cep'];
    $valorFrete = str_replace(',', '.', $_GET['frete']);

    $Carrinho = new Carrinho(NULL, $id_cliente, $data, $ip, $cep, $valorFrete);

    $CarrinhoDAO->inserir($Carrinho);

    $id_carrinho = $CarrinhoDAO->getLastID();

    foreach ($_COOKIE['carrinho'] as $cookie_name => $cookie_value) {

        $CarrinhoProdutos = new CarrinhoProdutos(NULL, $id_carrinho, $cookie_name, $cookie_value);
        $CarrinhoProdutosDAO->inserir($CarrinhoProdutos);

        $Produto = $ProdutoDAO->consultar($cookie_name);
        $Produto->setQtEstoque($Produto->getQtEstoque() - $cookie_value);

        $ProdutoDAO->atualizar($Produto);

        setcookie("carrinho[$cookie_name]", "", time() - 3600);
    }

    echo 'Compra Efetuada com Sucesso!';
}
