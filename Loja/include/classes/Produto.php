<?php

class Produto {

    private $id;
    private $idCategoria;
    private $nome;
    private $descricao;
    private $preco;
    private $foto;
    private $qtEstoque;

    public function __construct($id, $idCategoria, $nome, $descricao, $preco, $foto, $qtEstoque) {
        $this->id = $id;
        $this->idCategoria = $idCategoria;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->foto = $foto;
        $this->qtEstoque = $qtEstoque;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getQtEstoque() {
        return $this->qtEstoque;
    }

    public function setQtEstoque($qtEstoque) {
        $this->qtEstoque = $qtEstoque;
    }

}
