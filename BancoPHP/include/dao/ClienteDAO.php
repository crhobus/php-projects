<?php

class ClienteDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Cliente $Cliente) {
        $prepare = $this->factory->prepare("INSERT INTO clientes (nome, nr_conta, agencia, senha, letras_seguranca, saldo, nr_tentativas, saldo_especial, foto)"
                . " VALUES (:nome, :nr_conta, :agencia, :senha, :letras_seguranca, :saldo, :nr_tentativas, :saldo_especial, :foto)");
        $this->factory->bindParam($prepare, ":nome", $Cliente->getNome());
        $this->factory->bindParam($prepare, ":nr_conta", $Cliente->getNrConta());
        $this->factory->bindParam($prepare, ":agencia", $Cliente->getAgencia());
        $this->factory->bindParam($prepare, ":senha", $Cliente->getSenha());
        $this->factory->bindParam($prepare, ":letras_seguranca", $Cliente->getLetrasSeguranca());
        $this->factory->bindParam($prepare, ":saldo", $Cliente->getSaldo());
        $this->factory->bindParam($prepare, ":nr_tentativas", $Cliente->getNrTentativas());
        $this->factory->bindParam($prepare, ":saldo_especial", $Cliente->getSaldoEspecial());
        $this->factory->bindParam($prepare, ":foto", $Cliente->getFoto());
        return $this->factory->execute($prepare);
    }

    public function atualizar(Cliente $Cliente) {
        $prepare = $this->factory->prepare("UPDATE clientes SET nome = :nome, nr_conta = :nr_conta, agencia = :agencia, senha = :senha, letras_seguranca = :letras_seguranca, saldo = :saldo, nr_tentativas = :nr_tentativas, saldo_especial = :saldo_especial, foto = :foto WHERE id = :id");
        $this->factory->bindParam($prepare, ":nome", $Cliente->getNome());
        $this->factory->bindParam($prepare, ":nr_conta", $Cliente->getNrConta());
        $this->factory->bindParam($prepare, ":agencia", $Cliente->getAgencia());
        $this->factory->bindParam($prepare, ":senha", $Cliente->getSenha());
        $this->factory->bindParam($prepare, ":letras_seguranca", $Cliente->getLetrasSeguranca());
        $this->factory->bindParam($prepare, ":saldo", $Cliente->getSaldo());
        $this->factory->bindParam($prepare, ":nr_tentativas", $Cliente->getNrTentativas());
        $this->factory->bindParam($prepare, ":saldo_especial", $Cliente->getSaldoEspecial());
        $this->factory->bindParam($prepare, ":foto", $Cliente->getFoto());
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
        $retorno = $this->factory->executeFA($prepare);
        if ($retorno) {
            return new Cliente($retorno['id'], $retorno['nome'], $retorno['nr_conta'], $retorno['agencia'], $retorno['senha'], $retorno['letras_seguranca'], $retorno['saldo'], $retorno['nr_tentativas'], $retorno['saldo_especial'], $retorno['foto']);
        } else {
            return false;
        }
    }

    public function listar() {
        $prepare = $this->factory->prepare("SELECT * FROM clientes");
        $listaArray = $this->factory->executeFALL($prepare);
        if ($listaArray) {
            foreach ($listaArray as $retorno) {
                $lista[] = new Cliente($retorno['id'], $retorno['nome'], $retorno['nr_conta'], $retorno['agencia'], $retorno['senha'], $retorno['letras_seguranca'], $retorno['saldo'], $retorno['nr_tentativas'], $retorno['saldo_especial'], $retorno['foto']);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function consultaLogin($agencia, $nrConta) {
        $prepare = $this->factory->prepare("SELECT * FROM clientes WHERE agencia = :agencia AND nr_conta = :nr_conta");
        $this->factory->bindParam($prepare, ":agencia", $agencia);
        $this->factory->bindParam($prepare, ":nr_conta", $nrConta);
        $retorno = $this->factory->executeFA($prepare);
        if ($retorno) {
            return new Cliente($retorno['id'], $retorno['nome'], $retorno['nr_conta'], $retorno['agencia'], $retorno['senha'], $retorno['letras_seguranca'], $retorno['saldo'], $retorno['nr_tentativas'], $retorno['saldo_especial'], $retorno['foto']);
        } else {
            return false;
        }
    }

    public function getLastID() {
        return $this->factory->getLastID();
    }

}
