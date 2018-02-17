<?php

class Factory {

    private static $instance;
    private $host = "localhost";
    private $dataBase = "bancoDB";
    private $user = "root";
    private $password = "key50100";
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;port=3306;dbname=$this->dataBase", $this->user, $this->password);
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
        return $this->connection->prepare($sql);
    }

    public function bindParam($objPrepare, $bind, $value) {
        return $objPrepare->bindParam($bind, $value, PDO::PARAM_STR);
    }

    public function execute($objPrepare) {
        return $objPrepare->execute();
    }

    public function executeFA($objPrepare) {
        $objPrepare->execute();
        return $objPrepare->fetch();
    }

    public function executeFALL($objPrepare) {
        $objPrepare->execute();
        return $objPrepare->fetchAll();
    }

    public function getLastID() {
        return $this->connection->lastInsertId();
    }

    public function __destruct() {
        $this->connection = null;
    }

}
