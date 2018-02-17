<?php

class ProdutoDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function consultar($id) {
        $prepare = $this->factory->prepare("SELECT * FROM produtos WHERE id = :id");
        $this->factory->bindParam($prepare, ":id", $id);
        $retorno = $this->factory->executeFetch($prepare);
        if ($retorno) {
            return new Produto($retorno['id'], $retorno['id_departamento'], $retorno['nome'], $retorno['descricao'], $retorno['lance_inicial'], $retorno['lance_atual'], $retorno['foto'], $retorno['data_encerramento']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM produtos");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Produto($retorno['id'], $retorno['id_departamento'], $retorno['nome'], $retorno['descricao'], $retorno['lance_inicial'], $retorno['lance_atual'], $retorno['foto'], $retorno['data_encerramento']);
            }
            return $lista;
        } else {
            return false;
        }
    }

}
