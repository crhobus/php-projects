<?php

class ClienteDAO {

    private $factory;

    public function __construct() {
        $this->factory = Factory::getInstance();
    }

    public function inserir(Cliente $Cliente) {
        $prepare = $this->factory->prepare("INSERT INTO clientes (tipo_pessoa, login, senha, nome, cpf, rg, sexo, estado_civil, data_nascimento, celular, email, oferta_parceiros)"
                . " VALUES (:tipo_pessoa, :login, :senha, :nome, :cpf, :rg, :sexo, :estado_civil, :data_nascimento , :celular, :email, :oferta_parceiros)");
        $this->factory->bindParam($prepare, ":tipo_pessoa", $Cliente->getTipo_pessoa());
        $this->factory->bindParam($prepare, ":login", $Cliente->getLogin());
        $this->factory->bindParam($prepare, ":senha", $Cliente->getSenha());
        $this->factory->bindParam($prepare, ":nome", $Cliente->getNome());
        $this->factory->bindParam($prepare, ":cpf", $Cliente->getCpf());
        $this->factory->bindParam($prepare, ":rg", $Cliente->getRg());
        $this->factory->bindParam($prepare, ":sexo", $Cliente->getSexo());
        $this->factory->bindParam($prepare, ":estado_civil", $Cliente->getEstado_civil());
        $this->factory->bindParam($prepare, ":data_nascimento", date("Y-m-d", strtotime($Cliente->getData_nascimento())));
        $this->factory->bindParam($prepare, ":celular", $Cliente->getCelular());
        $this->factory->bindParam($prepare, ":email", $Cliente->getEmail());
        $this->factory->bindParam($prepare, ":oferta_parceiros", $Cliente->getOferta_parceiros());
        return $this->factory->execute($prepare);
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

}
