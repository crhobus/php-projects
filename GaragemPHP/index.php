<?php

try {
    $Conexao = new PDO("mysql:host=localhost;port=3306;dbname=cadascarrosdb", "root", "key50100");
    $resultado = $Conexao->query("select * from carros")->fetchAll();
    print_r($resultado);

    foreach ($resultado as $carro) {
        echo $carro['nome'] . '<br/>';
    }
} catch (PDOException $ex) {
    print $ex->getMessage();
}
