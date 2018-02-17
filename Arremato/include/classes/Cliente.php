<?php

class Cliente {

    private $id;
    private $tipo_pessoa;
    private $login;
    private $senha;
    private $nome;
    private $cpf;
    private $rg;
    private $sexo;
    private $estado_civil;
    private $data_nascimento;
    private $celular;
    private $email;
    private $oferta_parceiros;

    function __construct($id, $tipo_pessoa, $login, $senha, $nome, $cpf, $rg, $sexo, $estado_civil, $data_nascimento, $celular, $email, $oferta_parceiros) {
        $this->id = $id;
        $this->tipo_pessoa = $tipo_pessoa;
        $this->login = $login;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->sexo = $sexo;
        $this->estado_civil = $estado_civil;
        $this->data_nascimento = $data_nascimento;
        $this->celular = $celular;
        $this->email = $email;
        $this->oferta_parceiros = $oferta_parceiros;
    }

    public function getId() {
        return $this->id;
    }

    public function getTipo_pessoa() {
        return $this->tipo_pessoa;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEstado_civil() {
        return $this->estado_civil;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getOferta_parceiros() {
        return $this->oferta_parceiros;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTipo_pessoa($tipo_pessoa) {
        $this->tipo_pessoa = $tipo_pessoa;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setOferta_parceiros($oferta_parceiros) {
        $this->oferta_parceiros = $oferta_parceiros;
    }

}
