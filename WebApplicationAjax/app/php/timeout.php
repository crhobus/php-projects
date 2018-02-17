<?php

header('Content-type: application/json, charset:UTF-8');

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];

$array = array('nome' => $nome, 'sobrenome' => $sobrenome);
$json = json_encode($array);

sleep(1);

echo $json;
