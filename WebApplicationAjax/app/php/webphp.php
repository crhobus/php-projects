<?php

header('Content-type: text/html, charset:UTF-8');

//echo 'Furb - Pós web';

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];

echo $nome . ' ' . $sobrenome;
