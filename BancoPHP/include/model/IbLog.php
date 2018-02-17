<?php

class IbLog {

    private $id;
    private $idCliente;
    private $data;

    public function __construct($id, $idCliente, $data) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->data = $data;
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

}
