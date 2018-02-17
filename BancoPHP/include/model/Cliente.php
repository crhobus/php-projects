<?php

class Cliente {

    private $id;
    private $nome;
    private $nrConta;
    private $agencia;
    private $senha;
    private $letrasSeguranca;
    private $saldo;
    private $nrTentativas;
    private $saldoEspecial;
    private $foto;

    public function __construct($id, $nome, $nrConta, $agencia, $senha, $letrasSeguranca, $saldo, $nrTentativas, $saldoEspecial, $foto) {
        $this->id = $id;
        $this->nome = $nome;
        $this->nrConta = $nrConta;
        $this->agencia = $agencia;
        $this->senha = $senha;
        $this->letrasSeguranca = $letrasSeguranca;
        $this->saldo = $saldo;
        $this->nrTentativas = $nrTentativas;
        $this->saldoEspecial = $saldoEspecial;
        $this->foto = $foto;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNrConta() {
        return $this->nrConta;
    }

    public function setNrConta($nrConta) {
        $this->nrConta = $nrConta;
    }

    public function getAgencia() {
        return $this->agencia;
    }

    public function setAgencia($agencia) {
        $this->agencia = $agencia;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getLetrasSeguranca() {
        return $this->letrasSeguranca;
    }

    public function setLetrasSeguranca($letrasSeguranca) {
        $this->letrasSeguranca = $letrasSeguranca;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getNrTentativas() {
        return $this->nrTentativas;
    }

    public function setNrTentativas($nrTentativas) {
        $this->nrTentativas = $nrTentativas;
    }

    public function getSaldoEspecial() {
        return $this->saldoEspecial;
    }

    public function setSaldoEspecial($saldoEspecial) {
        $this->saldoEspecial = $saldoEspecial;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

}
