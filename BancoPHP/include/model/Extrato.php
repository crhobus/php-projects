<?php

class Extrato {

    private $id;
    private $idCliente;
    private $data;
    private $descricao;
    private $valor;
    private $tipo;
    private $operacao;

    public function __construct($id, $idCliente, $data, $descricao, $valor, $tipo, $operacao) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->data = $data;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->tipo = $tipo;
        $this->operacao = $operacao;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getOperacao() {
        return $this->operacao;
    }

    public function setOperacao($operacao) {
        $this->operacao = $operacao;
    }

}
