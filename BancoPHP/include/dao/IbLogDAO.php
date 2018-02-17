<?php

class IbLogDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(IbLog $IbLog) {
        $prepare = $this->factory->prepare("INSERT INTO ib_log (id_cliente, data)"
                . " VALUES (:id_cliente, :data)");
        $this->factory->bindParam($prepare, ":id_cliente", $IbLog->getIdCliente());
        $this->factory->bindParam($prepare, ":data", $IbLog->getData());
        return $this->factory->execute($prepare);
    }

    public function listar($nome, $agencia, $nrConta) {
        $sql = "SELECT b.nome, b.agencia, b.nr_conta, a.data FROM ib_log a, clientes b ";
        $sql .= "WHERE a.id_cliente = b.id ";

        if (!empty($nome)) {
            $sql .= " AND b.nome LIKE '%" . $nome . "%'";
        }
        if (!empty($agencia)) {
            $sql .= " AND b.agencia = " . $agencia;
        }
        if (!empty($nrConta)) {
            $sql .= " AND b.nr_conta = " . $nrConta;
        }
        $prepare = $this->factory->prepare($sql);
        $listaArray = $this->factory->executeFALL($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = Array('nome' => $retorno['nome'],
                    'agencia' => $retorno['agencia'],
                    'nr_conta' => $retorno['nr_conta'],
                    'data' => date('d/m/Y H:i:s', strtotime($retorno['data'])));
            }
            return $lista;
        } else {
            return false;
        }
    }

}
