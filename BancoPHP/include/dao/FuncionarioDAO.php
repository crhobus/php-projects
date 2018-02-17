<?php

class FuncionarioDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Funcionario $Funcionario) {
        $prepare = $this->factory->prepare("INSERT INTO funcionarios (nome, usuario, senha)"
                . " VALUES (:nome, :usuario, :senha)");
        $this->factory->bindParam($prepare, ":nome", $Funcionario->getNome());
        $this->factory->bindParam($prepare, ":usuario", $Funcionario->getUsuario());
        $this->factory->bindParam($prepare, ":senha", $Funcionario->getSenha());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Funcionario $Funcionario) {
        $prepare = $this->factory->prepare("UPDATE funcionarios SET nome = :nome, usuario = :usuario, senha = :senha WHERE id = :id");
        $this->factory->bindParam($prepare, ":nome", $Funcionario->getNome());
        $this->factory->bindParam($prepare, ":usuario", $Funcionario->getUsuario());
        $this->factory->bindParam($prepare, ":senha", $Funcionario->getSenha());
        $this->factory->bindParam($prepare, ":id", $Funcionario->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM funcionarios WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM funcionarios WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFA($prepare);
        if ($retorno) {
            return new Funcionario($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM funcionarios");
        $listaArray = $this->factory->executeFALL($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Funcionario($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function consultaLogin($usuario) {
        $prepare = $this->factory->prepare("SELECT * FROM funcionarios WHERE usuario = :usuario");
        $this->factory->bindParam($prepare, ":usuario", $usuario);
        $retorno = $this->factory->executeFA($prepare);
        if ($retorno) {
            return new Funcionario($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
        } else {
            return false;
        }
    }

    public function getLastID() {
        return $this->factory->getLastID();
    }

    public function getQtdFuncionarios() {
        $prepare = $this->factory->prepare("SELECT count(*) qt_registros FROM funcionarios");
        return $this->factory->executeFA($prepare);
    }

}
