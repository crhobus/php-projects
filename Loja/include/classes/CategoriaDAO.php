<?php

class CategoriaDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Categoria $Categoria) {
        $prepare = $this->factory->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        $this->factory->bindParam($prepare, ":nome", $Categoria->getNome());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Categoria $Categoria) {
        $prepare = $this->factory->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
        $this->factory->bindParam($prepare, ":nome", $Categoria->getNome());
        $this->factory->bindParam($prepare, ":id", $Categoria->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM categorias WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM categorias WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Categoria($retorno['id'], $retorno['nome']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM categorias");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Categoria($retorno['id'], $retorno['nome']);
            }
            return $lista;
        } else {
            return false;
        }
    }

}
