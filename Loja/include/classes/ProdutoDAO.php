<?php

class ProdutoDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Produto $Produto) {
        $prepare = $this->factory->prepare("INSERT INTO produtos (id_categoria, nome, descricao, preco, foto, qt_estoque)"
                . " VALUES (:id_categoria, :nome, :descricao, :preco, :foto, :qt_estoque)");
        $this->factory->bindParam($prepare, ":id_categoria", $Produto->getIdCategoria());
        $this->factory->bindParam($prepare, ":nome", $Produto->getNome());
        $this->factory->bindParam($prepare, ":descricao", $Produto->getDescricao());
        $this->factory->bindParam($prepare, ":preco", $Produto->getPreco());
        $this->factory->bindParam($prepare, ":foto", $Produto->getFoto());
        $this->factory->bindParam($prepare, ":qt_estoque", $Produto->getQtEstoque());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Produto $Produto) {
        $prepare = $this->factory->prepare("UPDATE produtos SET id_categoria = :id_categoria, nome = :nome, descricao = :descricao,"
                . " preco = :preco, foto = :foto, qt_estoque = :qt_estoque WHERE id = :id");
        $this->factory->bindParam($prepare, ":id_categoria", $Produto->getIdCategoria());
        $this->factory->bindParam($prepare, ":nome", $Produto->getNome());
        $this->factory->bindParam($prepare, ":descricao", $Produto->getDescricao());
        $this->factory->bindParam($prepare, ":preco", $Produto->getPreco());
        $this->factory->bindParam($prepare, ":foto", $Produto->getFoto());
        $this->factory->bindParam($prepare, ":qt_estoque", $Produto->getQtEstoque());
        $this->factory->bindParam($prepare, ":id", $Produto->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM produtos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM produtos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Produto($retorno['id'], $retorno['id_categoria'], $retorno['nome'], $retorno['descricao'], $retorno['preco'], $retorno['foto'], $retorno['qt_estoque']);
        } else {
            return false;
        }
    }

    public function listar($idCategoria) {
        $sql = "SELECT * FROM produtos";
        if (!empty($idCategoria)) {
            $sql .= " WHERE id_categoria = " . $idCategoria;
        }
        $prepare = $this->factory->prepare($sql);
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Produto($retorno['id'], $retorno['id_categoria'], $retorno['nome'], $retorno['descricao'], $retorno['preco'], $retorno['foto'], $retorno['qt_estoque']);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function getLastID() {
        return $this->factory->getLastID();
    }

}
