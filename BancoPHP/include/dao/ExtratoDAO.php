<?php

class ExtratoDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Extrato $Extrato) {
        $prepare = $this->factory->prepare("INSERT INTO extrato (id_cliente, data, descricao, valor, tipo, operacao)"
                . " VALUES (:id_cliente, :data, :descricao, :valor, :tipo, :operacao)");
        $this->factory->bindParam($prepare, ":id_cliente", $Extrato->getIdCliente());
        $this->factory->bindParam($prepare, ":data", $Extrato->getData());
        $this->factory->bindParam($prepare, ":descricao", $Extrato->getDescricao());
        $this->factory->bindParam($prepare, ":valor", $Extrato->getValor());
        $this->factory->bindParam($prepare, ":tipo", $Extrato->getTipo());
        $this->factory->bindParam($prepare, ":operacao", $Extrato->getOperacao());
        return $this->factory->execute($prepare);
    }

    public function listar($idCliente, $dtInicial, $dtFinal) {
        $sql = "SELECT b.nome, b.agencia, b.nr_conta, a.data, a.descricao, a.valor, a.tipo, a.operacao FROM extrato a, clientes b ";
        $sql .= "WHERE a.id_cliente = b.id ";
        $sql .= "AND a.id_cliente = :id_cliente ";
        $sql .= "AND a.data BETWEEN STR_TO_DATE(:dt_inicial,'%d/%m/%Y %H:%i:%s') AND STR_TO_DATE(:dt_final,'%d/%m/%Y %H:%i:%s')";
        $prepare = $this->factory->prepare($sql);
        $this->factory->bindParam($prepare, ":id_cliente", $idCliente);
        $this->factory->bindParam($prepare, ":dt_inicial", $dtInicial . " 00:00:00");
        $this->factory->bindParam($prepare, ":dt_final", $dtFinal . " 23:59:59");
        $listaArray = $this->factory->executeFALL($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = Array('nome' => $retorno['nome'],
                    'agencia' => $retorno['agencia'],
                    'nr_conta' => $retorno['nr_conta'],
                    'data' => date('d/m/Y H:i:s', strtotime($retorno['data'])),
                    'descricao' => $retorno['descricao'],
                    'valor' => "R$ " . number_format($retorno['valor'], 2, ',', '.'),
                    'tipo' => $retorno['tipo'],
                    'operacao' => $retorno['operacao']);
            }
            return $lista;
        } else {
            return false;
        }
    }

}
