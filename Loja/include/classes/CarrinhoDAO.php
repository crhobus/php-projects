<?php

class CarrinhoDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Carrinho $Carrinho) {
        $prepare = $this->factory->prepare("INSERT INTO carrinhos (id_cliente, data, ip, cep, valor_frete) VALUES (:id_cliente, :data, :ip, :cep, :valor_frete)");
        $this->factory->bindParam($prepare, ":id_cliente", $Carrinho->getIdCliente());
        $this->factory->bindParam($prepare, ":data", $Carrinho->getData());
        $this->factory->bindParam($prepare, ":ip", $Carrinho->getIp());
        $this->factory->bindParam($prepare, ":cep", $Carrinho->getCep());
        $this->factory->bindParam($prepare, ":valor_frete", $Carrinho->getValorFrete());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Carrinho $Carrinho) {
        $prepare = $this->factory->prepare("UPDATE carrinhos SET id_cliente = :id_cliente, data = :data ip = :ip, cep = :cep, valor_frete = :valor_frete WHERE id = :id");
        $this->factory->bindParam($prepare, ":id_cliente", $Carrinho->getIdCliente());
        $this->factory->bindParam($prepare, ":data", $Carrinho->getData());
        $this->factory->bindParam($prepare, ":ip", $Carrinho->getIp());
        $this->factory->bindParam($prepare, ":cep", $Carrinho->getCep());
        $this->factory->bindParam($prepare, ":valor_frete", $Carrinho->getValorFrete());
        $this->factory->bindParam($prepare, ":id", $Carrinho->getId());
        return $this->factory->execute($prepare);
    }

    public function excluir($id) {
        $prepare = $this->factory->prepare("DELETE FROM carrinhos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        return $this->factory->execute($prepare);
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM carrinhos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Carrinho($retorno['id'], $retorno['id_cliente'], $retorno['data'], $retorno['ip'], $retorno['cep'], $retorno['valorFrete']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM carrinhos");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Carrinho($retorno['id'], $retorno['id_cliente'], $retorno['data'], $retorno['ip'], $retorno['cep'], $retorno['valorFrete']);
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
