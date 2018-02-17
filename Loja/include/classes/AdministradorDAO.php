<?php

class AdministradorDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Administrador $Administrador) {
        $prepare = $this->factory->prepare("INSERT INTO administradores (nome, usuario, senha) VALUES (:nome, :usuario, :senha)");
        $this->factory->bindParam($prepare, ":nome", $Administrador->getNome());
        $this->factory->bindParam($prepare, ":usuario", $Administrador->getUsuario());
        $this->factory->bindParam($prepare, ":senha", $Administrador->getSenha());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Administrador $Administrador) {
        $prepare = $this->factory->prepare("UPDATE administradores SET nome = :nome, usuario = :usuario, senha = :senha WHERE id = :id");
        $this->factory->bindParam($prepare, ":nome", $Administrador->getNome());
        $this->factory->bindParam($prepare, ":usuario", $Administrador->getUsuario());
        $this->factory->bindParam($prepare, ":senha", $Administrador->getSenha());
        $this->factory->bindParam($prepare, ":id", $Administrador->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM administradores WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM administradores WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Administrador($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM administradores");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Administrador($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function consultaLogin($usuario) {
        $prepare = $this->factory->prepare("SELECT * FROM administradores WHERE usuario= :usuario");
        $this->factory->bindParam($prepare, ":usuario", $usuario);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Administrador($retorno['id'], $retorno['nome'], $retorno['usuario'], $retorno['senha']);
        } else {
            return false;
        }
    }

    public function getQtdAdministradores() {
        $prepare = $this->factory->prepare("SELECT count(*) qt_registros FROM administradores");
        return $this->factory->executeFetch($prepare);
    }

}
