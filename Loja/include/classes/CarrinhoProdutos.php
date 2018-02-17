<?php

class CarrinhoProdutos {

    private $id;
    private $id_carrinho;
    private $id_produto;
    private $quantidade;

    public function __construct($id, $id_carrinho, $id_produto, $quantidade) {
        $this->id = $id;
        $this->id_carrinho = $id_carrinho;
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_carrinho() {
        return $this->id_carrinho;
    }

    public function setId_carrinho($id_carrinho) {
        $this->id_carrinho = $id_carrinho;
    }

    public function getId_produto() {
        return $this->id_produto;
    }

    public function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

}
