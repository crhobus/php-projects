<?php

class DepartamentoDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM departamentos");
        $listaArray = $this->factory->executeFetchAll($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Departamento($retorno['id'], $retorno['nome']);
            }
            return $lista;
        } else {
            return false;
        }
    }

}
