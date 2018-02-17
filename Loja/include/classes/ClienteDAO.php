<?php

class ClienteDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Cliente $Cliente) {
        $prepare = $this->factory->prepare("INSERT INTO clientes (nome, sobrenome, senha, email, endereco, cep, cidade, estado)"
                . " VALUES (:nome, :sobrenome, :senha, :email, :endereco, :cep, :cidade, :estado)");
        $this->factory->bindParam($prepare, ":nome", $Cliente->getNome());
        $this->factory->bindParam($prepare, ":sobrenome", $Cliente->getSobrenome());
        $this->factory->bindParam($prepare, ":senha", $Cliente->getSenha());
        $this->factory->bindParam($prepare, ":email", $Cliente->getEmail());
        $this->factory->bindParam($prepare, ":endereco", $Cliente->getEndereco());
        $this->factory->bindParam($prepare, ":cep", $Cliente->getCep());
        $this->factory->bindParam($prepare, ":cidade", $Cliente->getCidade());
        $this->factory->bindParam($prepare, ":estado", $Cliente->getEstado());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Cliente $Cliente) {
        $prepare = $this->factory->prepare("UPDATE clientes SET nome = :nome, sobrenome = :sobrenome, senha = :senha,"
                . " email = :email, endereco = :endereco, cep = :cep, cidade = :cidade, estado = :estado WHERE id = :id");
        $this->factory->bindParam($prepare, ":nome", $Cliente->getNome());
        $this->factory->bindParam($prepare, ":sobrenome", $Cliente->getSobrenome());
        $this->factory->bindParam($prepare, ":senha", $Cliente->getSenha());
        $this->factory->bindParam($prepare, ":email", $Cliente->getEmail());
        $this->factory->bindParam($prepare, ":endereco", $Cliente->getEndereco());
        $this->factory->bindParam($prepare, ":cep", $Cliente->getCep());
        $this->factory->bindParam($prepare, ":cidade", $Cliente->getCidade());
        $this->factory->bindParam($prepare, ":estado", $Cliente->getEstado());
        $this->factory->bindParam($prepare, ":id", $Cliente->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM clientes WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM clientes WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Cliente($retorno['id'], $retorno['nome'], $retorno['sobrenome'], $retorno['senha'], $retorno['email'], $retorno['endereco'], $retorno['cep'], $retorno['cidade'], $retorno['estado']);
        } else {
            return false;
        }
    }

    public function verificaEmailCadastrado($email) {
        $prepare = $this->factory->prepare("SELECT id FROM clientes WHERE email = :email");
        $this->factory->bindParam($prepare, ":email", $email);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return $retorno['id'];
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM clientes");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Cliente($retorno['id'], $retorno['nome'], $retorno['sobrenome'], $retorno['senha'], $retorno['email'], $retorno['endereco'], $retorno['cep'], $retorno['cidade'], $retorno['estado']);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function consultaLogin($email) {
        $prepare = $this->factory->prepare("SELECT * FROM clientes WHERE email= :email");
        $this->factory->bindParam($prepare, ":email", $email);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Cliente($retorno['id'], $retorno['nome'], $retorno['sobrenome'], $retorno['senha'], $retorno['email'], $retorno['endereco'], $retorno['cep'], $retorno['cidade'], $retorno['estado']);
        } else {
            return false;
        }
    }

}
