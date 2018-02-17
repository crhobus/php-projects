<?php

include('../include/global.php');

$LojaSession = new LojaSession();

if (!$LojaSession->obterAdministradorSession()) {
    header("Location: index.php");
}

$ProdutoDAO = new ProdutoDAO();
$lista = $ProdutoDAO->listar('');

if ($lista) {
    $xml = new SimpleXMLElement('<?xml version="1.0" ?><produtos/>');
    foreach ($lista as $Produto) {
        $produtoXML = $xml->addChild('produto');
        $produtoXML->addChild('id', $Produto->getId());
        $produtoXML->addChild('id_categoria', $Produto->getIdCategoria());
        $produtoXML->addChild('nome', $Produto->getNome());
        $produtoXML->addChild('descricao', $Produto->getDescricao());
        $produtoXML->addChild('preco', $Produto->getPreco());
        $produtoXML->addChild('foto', $Produto->getFoto());
        $produtoXML->addChild('qt_estoque', $Produto->getQtEstoque());
    }
    echo $xml->asXML();
    file_put_contents('produtos.xml', $xml->asXML());
}
