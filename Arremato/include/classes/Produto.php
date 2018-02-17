<?php

class Produto {

    private $id;
    private $id_departamento;
    private $nome;
    private $descricao;
    private $lance_inicial;
    private $lance_atual;
    private $foto;
    private $data_encerramento;

    public function __construct($id, $id_departamento, $nome, $descricao, $lance_inicial, $lance_atual, $foto, $data_encerramento) {
        $this->id = $id;
        $this->id_departamento = $id_departamento;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->lance_inicial = $lance_inicial;
        $this->lance_atual = $lance_atual;
        $this->foto = $foto;
        $this->data_encerramento = $data_encerramento;
    }

    public function getId() {
        return $this->id;
    }

    public function getId_departamento() {
        return $this->id_departamento;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLance_inicial() {
        return $this->lance_inicial;
    }

    public function getLance_atual() {
        return $this->lance_atual;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getData_encerramento() {
        return $this->data_encerramento;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_departamento($id_departamento) {
        $this->id_departamento = $id_departamento;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setLance_inicial($lance_inicial) {
        $this->lance_inicial = $lance_inicial;
    }

    public function setLance_atual($lance_atual) {
        $this->lance_atual = $lance_atual;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setData_encerramento($data_encerramento) {
        $this->data_encerramento = $data_encerramento;
    }

}
