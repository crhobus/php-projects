<?php

class CarrinhoProdutosDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(CarrinhoProdutos $CarrinhoProdutos) {
        $prepare = $this->factory->prepare("INSERT INTO carrinho_produtos (id_carrinho, id_produto, quantidade) VALUES (:id_carrinho, :id_produto, :quantidade)");
        $this->factory->bindParam($prepare, ":id_carrinho", $CarrinhoProdutos->getId_carrinho());
        $this->factory->bindParam($prepare, ":id_produto", $CarrinhoProdutos->getId_produto());
        $this->factory->bindParam($prepare, ":quantidade", $CarrinhoProdutos->getQuantidade());
        return $this->factory->execute($prepare);
    }

    public function atualizar(CarrinhoProdutos $CarrinhoProdutos) {
        $prepare = $this->factory->prepare("UPDATE carrinho_produtos SET id_carrinho = :id_carrinho, id_produto = :id_produto, quantidade = :quantidade  WHERE id = :id");
        $this->factory->bindParam($prepare, ":id_carrinho", $CarrinhoProdutos->getId_carrinho());
        $this->factory->bindParam($prepare, ":id_produto", $CarrinhoProdutos->getId_produto());
        $this->factory->bindParam($prepare, ":quantidade", $CarrinhoProdutos->getQuantidade());
        $this->factory->bindParam($prepare, ":id", $CarrinhoProdutos->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM carrinho_produtos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM carrinho_produtos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new CarrinhoProdutos($retorno['id'], $retorno['id_carrinho'], $retorno['id_produto'], $retorno['quantidade']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM carrinho_produtos");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new CarrinhoProdutos($retorno['id'], $retorno['id_carrinho'], $retorno['id_produto'], $retorno['quantidade']);
            }
            return $lista;
        } else {
            return false;
        }
    }

}
