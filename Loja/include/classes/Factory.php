<?php

class Factory {

    private static $instance;
    private $servidor = "localhost";
    private $banco = "loja";
    private $usuario = "root";
    private $senha = "key50100";
    private $conexao;

    private function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=$this->servidor;port=3306;dbname=$this->banco", $this->usuario, $this->senha);
        } catch (PDOException $i) {
            echo $i->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function prepare($sql) {
        return $this->conexao->prepare($sql);
    }

    public function bindParam($objPrepare, $bind, $value) {
        return $objPrepare->bindParam($bind, $value, PDO::PARAM_STR);
    }

    public function execute($objPrepare) {
        return $objPrepare->execute();
    }

    public function executeFetch($objPrepare) {
        $objPrepare->execute();
        return $objPrepare->fetch();
    }

    public function executeFetchAll($objPrepare) {
        $objPrepare->execute();
        return $objPrepare->fetchAll();
    }

    public function getLastID() {
        return $this->conexao->lastInsertId();
    }

    public function __destruct() {
        $this->conexao = null;
    }

}
