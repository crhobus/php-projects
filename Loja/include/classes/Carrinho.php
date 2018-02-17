<?php

class Carrinho {

    private $id;
    private $idCliente;
    private $data;
    private $ip;
    private $cep;
    private $valorFrete;

    public function __construct($id, $idCliente, $data, $ip, $cep, $valorFrete) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->data = $data;
        $this->ip = $ip;
        $this->cep = $cep;
        $this->valorFrete = $valorFrete;
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

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getValorFrete() {
        return $this->valorFrete;
    }

    public function setValorFrete($valorFrete) {
        $this->valorFrete = $valorFrete;
    }

}
